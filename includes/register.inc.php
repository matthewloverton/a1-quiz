<?php

    // Check to see if they got here from a register button.
    if(isset($_POST['register_submit'])){

        // Include database connection.
        require 'db.inc.php';

        // Retrive variables from the form.
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];

        // Validation
        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            header("Location: ../pages/register.php?error=emptyFields&username=".$username."&email=".$email);
            exit();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../pages/register.php?error=invalidEmail&username=".$username);
            exit();
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username) || $username == "admin") {
            header("Location: ../pages/register.php?error=invalidUsername&email=".$email);
            exit();
        }
        elseif ($password !== $passwordRepeat) {
            header("Location: ../pages/register.php?error=passwordCheck&username=".$username."&email=".$email);
            exit();
        } 
        else {

            // SQL statement to select a user from the database with the username.
            $sql = "SELECT f_username FROM tbl_user WHERE f_username = ?";

            // Check to see if there is an error with the SQL.
            if(!$stmt = $mysqli->prepare($sql)){
                echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
            }
            // Bind variables to the '?' in the SQL statement.
            $stmt->bind_param("s", $username);
            // Run the Query.
            $stmt->execute();
            $stmt->store_result();
            // Check to see if there are any results.
            $resultCheck = $stmt->num_rows();
            // If there is a result redirect to the register page with a username taken error.
            if ($resultCheck > 0) {
                header("Location: ../pages/register.php?error=userTaken&email=".$email);
                exit();
            }
            else {
                // SQL statement to select a user from the database with the email.
                $sql = "SELECT f_email FROM tbl_user WHERE f_email = ?";

                if(!$stmt = $mysqli->prepare($sql)){
                    echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
                }
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $resultCheck = $stmt->num_rows();
                // If there is a result redirect to the register page with a email taken error.
                if ($resultCheck > 0) {
                    header("Location: ../pages/register.php?error=emailUsed&username=".$username);
                    exit();
                }
            }
        }
        // SQL statement to insert a new user into the database
        $sql = "INSERT INTO tbl_user (f_username, f_password, f_email, f_admin, f_banned) values (?, ?, ?, ?, ?)";
        
        if(!$stmt = $mysqli->prepare($sql)){
            echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
        }
        // Hash password with the default encryption.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssii", $username, $hashedPassword, $email, $admin = 0, $banned = 0);
        $stmt->execute();
        
        // Close SQL statement and database connection.
        $stmt->close();
        $mysqli->close();

        // Redirect to the homepage.
        header("Location: ../pages/login.php?success=register");
        exit();
    }
    else {
        header("Location: ../pages/register.php");
        exit();
    }
?>
