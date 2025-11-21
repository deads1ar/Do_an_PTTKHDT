<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session on the server
session_destroy();

// Clear the session cookie from the browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Redirect to login page
echo "<script type='text/javascript'> window.location.href='./index.php';</script>";
?>