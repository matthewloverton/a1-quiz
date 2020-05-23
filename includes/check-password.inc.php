<?php

    require "db.inc.php";

    $quizID = $_POST['quizID'];
    $password = $_POST['password'];

    // Find the password hash for the current quiz
    $sql = "SELECT f_password FROM tbl_quiz WHERE f_quizID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    $stmt->bind_param("i", $quizID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $passwordhash = $row['f_password'];

    // Set a bool for the result of verifying the password.
    $response = password_verify($password, $passwordhash);

    if ($response) {
        $answer = "correct";
    }
    else{
        $answer = "incorrect";
    }

    // Send the response back in json format.
    echo json_encode($answer);

?>