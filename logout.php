<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to Home.php after logout
header('Location: Home.php');
exit();
?>