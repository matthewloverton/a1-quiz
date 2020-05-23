<?php

// Check to see if they got here from a login button.
if(isset($_POST['login_submit'])){

    // Include database connection
    require 'db.inc.php';

    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // If fields are empty send an error.
    if (empty($username) || empty($password)) {
        header("Location: ../pages/login.php?error=emptyFields");
        exit();
    }
    else {
        // SQL statement to select a user from the database with the username or email provided.
        $sql = "SELECT * FROM tbl_user WHERE f_username = ? OR f_email = ?";

        // Check to see if there is an error with the SQL.
        if(!$stmt = $mysqli->prepare($sql)){
            echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
        }
        // Bind variables to the '?' in the SQL statement.
        $stmt->bind_param("ss", $username, $username);
        // Run the Query.
        $stmt->execute();
        // Store the result of the query in a variable.
        $result = $stmt->get_result();
        // Store the result as an array.
        if ($row = $result->fetch_assoc()) {
            // Verify the hashed passwords match.
           $passwordCheck = password_verify($password, $row['f_password']);
           if (!$passwordCheck) {
            header("Location: ../pages/login.php?error=wrongPassword");
            exit();
           }
           else {
               // Check to see if they user is currently banned.
               if ($row['f_banned'] === 1) {
                   header("Location: ../pages/login.php?error=userBanned");
                   exit();
               }
               // Start a session and store some information about the user.
               session_start();
               $_SESSION['userID'] = $row['f_userID'];
               $_SESSION['username'] = $row['f_username'];
               $_SESSION['admin'] = $row['f_admin'];

               header("Location: ../index.php?login=success");
                exit();
           }
        }
        else{
            // If no user was found send an error.
            header("Location: ../pages/login.php?error=noUser");
            exit();
        }
    }
    // Close SQL statement and database connection.
    $stmt->close();
    $mysqli->close();
}
else {
    // Redirect to the homepage
    header("Location: ../index.php");
    exit();
}

?>