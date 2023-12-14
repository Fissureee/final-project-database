<?php
session_start();

// Clear session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../organizer/login.php");
exit();

?>