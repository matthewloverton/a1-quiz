<?php

// Check to see if we got here from the correct submit button.
if (isset($_POST['add_quiz_submit'])) {
    
    // import db variables and connection.
    require 'db.inc.php';

    $username = $_POST['username'];
    // Check to see if a password has been entered.
    if (isset($_POST['quizPassword']) && ($_POST['quizPassword'] != null || $_POST['quizPassword'] != "")) {
        $quizPassword = $_POST['quizPassword'];
        $quizPasswordHash = password_hash($quizPassword, PASSWORD_DEFAULT);
    }
    else{
        $quizPassword = null;
        $quizPasswordHash = null;
    }
    // Check to see if attempts have been set.
    if (isset($_POST['quizAttempts'])) {
        $quizAttempts = $_POST['quizAttempts'];
    }
    else{
        $quizAttempts = null;
    }
    $quizTitle = $_POST['quizTitle'];
    $currentDate = date("Y-m-d H:i:s");

    // GET USERID FROM USERNAME
    $sql = "SELECT f_userID FROM tbl_user WHERE f_username = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    // Bind variables to the '?' in the SQL statement.
    $stmt->bind_param("s", $username);
    // Run the Query.
    $stmt->execute();
    // Store the result of the query in a variable.
    $result = $stmt->get_result();
    // Store the result as an array.
    if ($row = $result->fetch_assoc()){
        $userID = $row['f_userID'];
    }
    $stmt->close();

    // INSERT QUIZ TO TABLE
    $sql = "INSERT INTO tbl_quiz (f_quizTitle, f_userID, f_password, f_attempts, f_dateCreated) values (?, ?, ?, ?, ?)";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    $stmt->bind_param("sisis", $quizTitle, $userID, $quizPasswordHash, $quizAttempts, $currentDate);
    $stmt->execute();
    $stmt->close();

    // SELECT THE NEW QUIZID
    $sql = "SELECT f_quizID FROM tbl_quiz WHERE f_quizTitle = ? AND f_userID = ? AND f_dateCreated = ?";
    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    // Bind variables to the '?' in the SQL statement.
    $stmt->bind_param("sis", $quizTitle, $userID, $currentDate);
    // Run the Query.
    $stmt->execute();
    // Store the result of the query in a variable.
    $result = $stmt->get_result();
    // Store the result as an array.
    if ($row = $result->fetch_assoc()){
        $quizID = $row['f_quizID'];
    }
    $stmt->close();

    $rows = $_POST['question'];
    $args = array_fill(0, count($rows[0]), '?');

    // INSERT QUESTIONS INTO TABLE
    $sql = "INSERT INTO tbl_question (f_quizID, f_questionTitle, f_choice1, f_choice2, f_choice3, f_answer) values (?, ".implode(', ', $args).")";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    foreach ($rows as $row){
        $stmt->bind_param("isssss", $quizID, $row['questionTitle'], $row['choice1'], $row['choice2'], $row['choice3'], $row['answer']);
        $stmt->execute();
    }
    $stmt->close();

    header("Location: ../pages/quizzes.php");
}
else{
    // Redirect to the homepage
    header("Location: ../index.php");
    exit();
}

?>