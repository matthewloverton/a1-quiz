<?php

    require "../includes/db.inc.php";

    // Delete/Ban Users
    $sql = "SELECT * FROM tbl_user WHERE f_admin != 1";

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $usertable = "<table class='table table-primary' id='users'>
                      <thead>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Banned</th>
                          <th>Ban?</th>
                          <th>Delete?</th>
                      </thead>
                      <tbody>";

        while ($row = $result->fetch_array()) {
            $userID = $row['f_userID'];

            $username = $row['f_username'];
            $email = $row['f_email'];
            if ($row['f_banned'] == 0) {
                $banned = "No";
            }
            else{
                $banned = "Yes";
            }
            $ban = "<button class='btn btn-sm btn-light js-scroll-trigger' data-record-id='$userID' data-record-title='$username' data-toggle='modal' data-target='#confirm-ban-user'>Ban!</button>";

            $delete = "<button class='btn btn-sm btn-danger js-scroll-trigger' data-record-id='$userID' data-record-title='$username' data-toggle='modal' data-target='#confirm-delete-user'>Delete!</button>";
            
            $usertable.= "<tr>";
            $usertable.= "<td> $username </td>";
            $usertable.= "<td> $email </td>";
            $usertable.= "<td> $banned </td>";
            $usertable.= "<td> $ban </td>";
            $usertable.= "<td> $delete </td>";
            $usertable.= "</tr>";
        }
        $usertable.= "</tbody></table>";
    }
    // Delete Quizzes
    $sql = "SELECT tbl_quiz.f_quizID, tbl_quiz.f_quizTitle, tbl_quiz.f_password, tbl_quiz.f_attempts, tbl_quiz.f_dateCreated, tbl_user.f_username FROM tbl_quiz INNER JOIN tbl_user ON tbl_quiz.f_userID = tbl_user.f_userID";

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $quiztable = "<table class='table table-dark' id='adminQuizzes'>
                      <thead>
                          <th>Quiz</th>
                          <th>Author</th>
                          <th>Password</th>
                          <th>Attempts</th>
                          <th>Created</th>
                          <th>Delete?</th>
                      </thead>
                      <tbody>";

        while ($row = $result->fetch_assoc()) {
            $title = $row['f_quizTitle'];
            $quizID = $row['f_quizID'];
            if ($row['f_password'] == null) {
                $password = "<i class='white-icon' data-feather='unlock'></i>";
            }
            else{
                $password = "<i class='white-icon' data-feather='lock'></i>";
            }
            if ($row['f_attempts'] == 0){
                $attempts = "Unlimited";
            }
            else{
                $attempts = $row['f_attempts'];
            }
            $date = date("d-m-Y", strtotime($row['f_dateCreated']));
            $author = $row['f_username'];
            $delete = "<button class='btn btn-sm btn-danger js-scroll-trigger' data-record-id='$quizID' data-record-title='$title' data-toggle='modal' data-target='#confirm-delete-quiz'>Delete!</button>";

            $quiztable.= "<tr>";
            $quiztable.= "<td> $title </td>";
            $quiztable.= "<td> $author </td>";
            $quiztable.= "<td> $password </td>";
            $quiztable.= "<td> $attempts </td>";
            $quiztable.= "<td> $date </td>";
            $quiztable.= "<td> $delete </td>";
            $quiztable.= "</tr>";
        }
        $quiztable.= "</tbody></table>";
    }

    //Display Quizzes
    $sql = "SELECT tbl_quiz.f_quizID, tbl_quiz.f_quizTitle, tbl_quiz.f_password, tbl_quiz.f_attempts, tbl_quiz.f_dateCreated, tbl_user.f_username FROM tbl_quiz INNER JOIN tbl_user ON tbl_quiz.f_userID = tbl_user.f_userID";

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $datatable = "<table class='table table-dark' id='quizzes'>
        <thead>
            <th>Quiz</th>
            <th>Author</th>
            <th>Password</th>
            <th>Attempts</th>
            <th>Created</th>
            <th>Play</th>
        </thead>
        <tbody>";

        while ($row = $result->fetch_assoc()) {

            $title = $row['f_quizTitle'];
            $quizID = $row['f_quizID'];
            $date = date("d-m-Y", strtotime($row['f_dateCreated']));
            $author = $row['f_username'];

            if ($check = ($row['f_password'] == null)) {
                $password = "<i class='white-icon' data-feather='unlock'></i>";
                $play = "<button class='btn btn-light js-scroll-trigger' type='submit'>Play!</button>";
            }
            else{
                $password = "<i class='white-icon' data-feather='lock'></i>";
                $play = "<button class='btn btn-light js-scroll-trigger' data-record-id='$quizID' data-record-title='$title' data-record-author='$author' data-toggle='modal' data-target='#password-check'>Play!</button>";
            }
            if ($row['f_attempts'] == 0){
                $attempts = "Unlimited";
            }
            else{
                $attempts = $row['f_attempts'];
            }

            $datatable.= "<tr>";
            $datatable.= "<td> $title </td>";
            $datatable.= "<td> $author </td>";
            $datatable.= "<td> $password </td>";
            $datatable.= "<td> $attempts </td>";
            $datatable.= "<td> $date </td>";
            if (isset($_SESSION['userID']) && $check) {
                $datatable.= "<form action='play-quiz.php' method='post'>";
                $datatable.= "<td> $play </td>";
                $datatable.= "<input type='hidden' value='$title' name='quizTitle'>";
                $datatable.= "<input type='hidden' value='$quizID' name='quizID'>";
                $datatable.= "<input type='hidden' value='$author' name='author'>";
                $datatable.= "</form>";
            } else if (isset($_SESSION['userID'])) {
                $datatable.= "<td> $play </td>";
            }
            else{
                $datatable.= "<form action='login.php' method='post'>";
                $datatable.= "<td> $play </td>";
                $datatable.= "</form>";
            }
            $datatable.= "</tr>";
            
        }
        $datatable.= "</tbody></table>";
    }

    //Users Quizzes
    $sql = "SELECT tbl_quiz.f_quizID, tbl_quiz.f_quizTitle, tbl_quiz.f_password, tbl_quiz.f_attempts, tbl_quiz.f_dateCreated FROM tbl_quiz INNER JOIN tbl_user ON tbl_quiz.f_userID = tbl_user.f_userID WHERE tbl_quiz.f_userID = ";
    if (isset($_SESSION['userID'])) {
        $sql .= $_SESSION['userID'];
    }

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $createdtable = "<table class='table table-dark' id='userCreated'>
        <thead>
            <th>Quiz</th>
            <th>Password</th>
            <th>Attempts</th>
            <th>Created</th>
        </thead>
        <tbody>";

        while ($row = $result->fetch_assoc()) {

            $title = $row['f_quizTitle'];
            if ($row['f_password'] == null) {
                $password = "<i class='white-icon' data-feather='unlock'></i>";
            }
            else{
                $password = "<i class='white-icon' data-feather='lock'></i>";
            }
            if ($row['f_attempts'] == 0){
                $attempts = "Unlimited";
            }
            else{
                $attempts = $row['f_attempts'];
            }
            $quizID = $row['f_quizID'];
            $date = date("d-m-Y", strtotime($row['f_dateCreated']));

            $createdtable.= "<tr>";
            $createdtable.= "<td> $title </td>";
            $createdtable.= "<td> $password </td>";
            $createdtable.= "<td> $attempts </td>";
            $createdtable.= "<td> $date </td>";
            $createdtable.= "</tr>";
            
        }
        $createdtable.= "</tbody></table>";
    }

    //User Stats
    
    $sql = "SELECT tbl_quiz.f_quizTitle, tbl_leaderboard.f_score, tbl_leaderboard.f_timestamp FROM tbl_leaderboard INNER JOIN tbl_quiz ON tbl_leaderboard.f_quizID = tbl_quiz.f_quizID  WHERE tbl_leaderboard.f_userID = ";
    if (isset($_SESSION['userID'])) {
        $sql .= $_SESSION['userID'];
    }

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $statstable = "<table class='table table-dark' id='stats'>
        <thead>
            <th>Quiz</th>
            <th>Score</th>
            <th>Date</th>
        </thead>
        <tbody>";
        while ($row = $result->fetch_assoc()) {
            $title = $row['f_quizTitle'];
            $date = date("d-m-Y", strtotime($row['f_timestamp']));
            $score = $row['f_score'];
            $statstable.= "<tr>";
            $statstable.= "<td> $title </td>";
            $statstable.= "<td> $score </td>";
            $statstable.= "<td> $date </td>";
            $statstable.= "</tr>";
        }
        $statstable.= "</tbody></table>";
    }

    //Leaderboard
    $sql = "SELECT tbl_quiz.f_quizTitle, tbl_user.f_username, tbl_leaderboard.f_score, tbl_leaderboard.f_timestamp FROM tbl_leaderboard INNER JOIN tbl_quiz ON tbl_leaderboard.f_quizID = tbl_quiz.f_quizID INNER JOIN tbl_user ON tbl_user.f_userID = tbl_leaderboard.f_userID";

    if (!$result = $mysqli->query($sql)) {
        echo "<p>Query failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }
    else{
        $leaderboardtable = "<table class='table table-dark' id='leaderboard'>
        <thead>
            <th>Quiz</th>
            <th>Player</th>
            <th>Score</th>
            <th>Date</th>
        </thead>
        <tbody>";

        while ($row = $result->fetch_assoc()) {

            $title = $row['f_quizTitle'];
            $date = date("d-m-Y", strtotime($row['f_timestamp']));
            $player = $row['f_username'];
            $score = $row['f_score'];

            $leaderboardtable.= "<tr>";
            $leaderboardtable.= "<td> $title </td>";
            $leaderboardtable.= "<td> $player </td>";
            $leaderboardtable.= "<td> $score </td>";
            $leaderboardtable.= "<td> $date </td>";
            $leaderboardtable.= "</tr>";
        }
        $leaderboardtable.= "</tbody></table>";
    }
?>