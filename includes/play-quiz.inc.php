<?php
        
        if (isset($_POST['quizID'])) {
            
            require "db.inc.php";

            $quizID = $_POST['quizID'];
            
            // Find the questions for the quiz from the quizID.
            $sql = "SELECT f_questionID, f_questionTitle, f_choice1, f_choice2, f_choice3, f_answer FROM tbl_question WHERE f_quizID = ?";

            if(!$stmt = $mysqli->prepare($sql)){
                echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
            }
            $stmt->bind_param("i", $quizID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Store the questions in an 2D array.
            $data = array();
            while($row = $result->fetch_assoc()) {
                $data[] = $row; 
            }

            // Reverse the Array so that the questions are in the correct order.
            $data = array_reverse($data);

            // Send the result back in json format.
            echo json_encode($data);

        }
?>