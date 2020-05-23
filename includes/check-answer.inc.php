<?php

    require "db.inc.php";

    $questionID = $_POST['questionID'];
    $choice = $_POST['choice'];
    $quizID = $_POST['quizID'];

    // Find the answer to the current question.
    $sql = "SELECT f_answer FROM tbl_question WHERE f_quizID = ? AND f_questionID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    $stmt->bind_param("ii", $quizID, $questionID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check to see if the choice selected is = to the the answer.
    if ($row['f_answer'] == $choice) {
        $answer = "correct";
    }
    else{
        $answer = "incorrect";
    }

    // Return the result in json format.
    echo json_encode($answer);

?>