<?php
session_start(); // Start the session

// Destroy all session data
session_unset(); 

// Destroy the session
session_destroy(); 

// Redirect to the login page with a logout message
header("Location: index.php?message=Logged out successfully"); 
exit;
?>
