<?php
session_start();

// Clear session variables
$_SESSION = array();

// Destroy session
session_destroy();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login
header("Location: login.php");
exit;
?>
