<?php

    require "db.inc.php";

    $userID = $_POST['f_userID'];

    // Delete the user.
    $sql = "DELETE FROM tbl_user WHERE f_userID = ?";

    if(!$stmt = $mysqli->prepare($sql)){
        echo "<p>Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "</p>";
    }

    $stmt->bind_param("i", $userID);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("Location: ../pages/admin.php");
?>