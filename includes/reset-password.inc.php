<?php

    // Check to see if they got here from a reset password button.
    if (isset($_POST['reset_password_submit'])) {

        // Include database connection.
        require 'db.inc.php';

        // Retrive variables from the form.
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];

        // Validation
        if (empty($password) || empty($passwordRepeat)) {
            header("Location: ../pages/reset-password.php?error=emptyFields&selector=$selector&validator=$validator");
            exit();
        }
        else if ($password != $passwordRepeat) {
            header("Location: ../pages/reset-password.php?error=passwordCheck&selector=$selector&validator=$validator");
            exit();
        }

        // Set the current date to the number of secconds passed since the Unix Epoch (January 1 1970 00:00:00).
        $currentDate = date("U");

        // SQL statement to select a row from the password reset table where the selector matches and hasn't expired.
        $sql = "SELECT * FROM tbl_pwdreset WHERE f_selector = ? AND f_expiry >= ?";

        if(!$stmt = $mysqli->prepare($sql)){
            echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
        }
        $stmt->bind_param("ss", $selector, $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        // If no results come up it has expired and you need to send a new reset request.
        if (!$row = $result->fetch_assoc()) {
            echo "You need to re-submit your reset request. [failed to find request]";
        }
        else {
            // Convert the hexedecimal validator to binary.
            $tokenBin = hex2bin($validator);
            // Check the token matches the token in the database.
            $tokenCheck = password_verify($tokenBin, $row['f_token']);
            // If the token fails you need to send a new reset request.
            if (!$tokenCheck) {
                echo "You need to resubmit your reset request [incorrect token]";
            }
            else {
                $tokenEmail = $row['f_email'];
                
                // SQL statement to check the email is in the database.
                $sql = "SELECT * FROM tbl_user WHERE f_email=?";

                if(!$stmt = $mysqli->prepare($sql)){
                    echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
                }
                $stmt->bind_param("s", $tokenEmail);
                $stmt->execute();

                $result = $stmt->get_result();
                if (!$row = $result->fetch_assoc()) {
                    echo "There was an error fetching.";
                }
                else {
                    // SQL statement to update the users password in the database.
                    $sql = "UPDATE tbl_user SET f_password = ? WHERE f_email = ?";
                    
                    // Hash the users new password with the default encryption
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    if(!$stmt = $mysqli->prepare($sql)){
                        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
                    }
                    $stmt->bind_param("ss", $passwordHash, $tokenEmail);
                    $stmt->execute();

                    // SQL statement to delete the row from the password reset table.
                    $sql = "DELETE FROM tbl_pwdreset WHERE f_email = ?";

                    if(!$stmt = $mysqli->prepare($sql)){
                        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
                    }
                    $stmt->bind_param("s", $tokenEmail);
                    $stmt->execute();

                    header("Location: ../pages/login.php?success=passwordUpdated");
                }
            }
        }
        // Close any SQL statements and the database connection.
        $stmt->close();
        $mysqli->close();
    }
    else {
        header('Location: ../index.php');
    }
?>