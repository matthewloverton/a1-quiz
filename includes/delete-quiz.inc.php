<?php

    require "db.inc.php";

    $quizID = $_POST['f_quizID'];

    // Delete the quiz.
    $sql = "DELETE FROM tbl_quiz WHERE f_quizID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }

    $stmt->bind_param("i", $quizID);
    $stmt->execute();

    $stmt->close();

    // Delete the questions in the quiz.
    $sql = "DELETE FROM tbl_question WHERE f_quizID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }

    $stmt->bind_param("i", $quizID);
    $stmt->execute();

    $stmt->close();

    $mysqli->close();

    header("Location: ../pages/admin.php");
?>