<?php

    require "db.inc.php";

    $userID = $_POST['f_userID'];

    // Update the banned column on the user.
    $sql = "UPDATE tbl_user SET f_banned = 1 WHERE f_userID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }

    $stmt->bind_param("i", $userID);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();
?>