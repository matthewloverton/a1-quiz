<?php

    // variables for DB stuff
    $DBHOST = "localhost";
    $DBUSER = "root";
    $DBPASS = "pass";
    $DBNAME = "db_whatscooking";

    // connection to the database
    $mysqli = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }
?>