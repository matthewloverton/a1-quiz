<?php

// Start the session, clear it and destroy it.
session_start();
session_unset();
session_destroy();

// Redirect to the homepage.
header("Location: ../index.php");

?>