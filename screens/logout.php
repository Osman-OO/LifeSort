<?php
session_start();

// Clear all session data
session_destroy();

// Redirect to login page
header('Location: login.php');
exit;
?>
