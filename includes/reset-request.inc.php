<?php

// Check to see if they got here from a reset button.
if (isset($_POST['reset_request_submit'])) {
    
    // Generate a selector and token.
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // Generate an email reset password link (convert token to hexadecimal).
    $url = "https://overtonportfolio.net/quiz/pages/reset-password.php?selector=$selector&validator=" . bin2hex($token);

    // Generate an expiry date.
    $expires = date("U") + 3600;

    // Include database connection.
    require "db.inc.php";

    $email = $_POST['email'];

    // Validation.
    if (empty($email)) {
        header("Location: ../pages/reset-request.php?error=emptyFields");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/reset-request.php?error=invalidEmail");
        exit();
    }
    else {
        $sql = "SELECT f_email FROM tbl_user WHERE f_email = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $resultCheck = $stmt->num_rows();
        if ($resultCheck === 0) {
            header("Location: ../pages/reset-request.php?error=noEmail");
            exit();
        }
    }
    $sql = "DELETE FROM tbl_pwdreset WHERE f_email = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $sql = "INSERT INTO tbl_pwdreset (f_email, f_selector, f_token, f_expiry) values (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $email, $selector, $hashedToken, $expires);
    $stmt->execute();

    // Close SQL statements and database connection.
    $stmt->close();
    $mysqli->close();

    $to = $email;
    $subject = "Reset your password for overtonportfolio.net";
    $message = "<p>We have recieved a password reset request. The link to reset your password is below. If you did not make this request
                you can ignore this email.</p><br><p>Here is your password reset link: <a href=$url>$url</a></p>";
    $headers = "From: overtonportfolio <info@overtonportfolio.net>\r\n";
    $headers .= "Reply-To: info@overtonportfolio.net\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../pages/login.php?success=reset");
}
else {
    header('Location: ../index.php');
}