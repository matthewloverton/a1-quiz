<?php

    require "db.inc.php";

    $score = $_POST['score'];
    $userID = $_POST['userID'];
    $quizID = $_POST['quizID'];
    $timestamp = date("Y-m-d H:i:s");
    
    // Insert entry into the leaderboard upon completing the quiz.    
    $sql = "INSERT INTO tbl_leaderboard (f_userID, f_quizID, f_score, f_timestamp) VALUES (?, ?, ?, ?)";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    $stmt->bind_param("iiis", $userID, $quizID, $score, $timestamp);
    $stmt->execute();
    $stmt->close();
?>