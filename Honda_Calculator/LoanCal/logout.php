<?php
session_start();

// destroy all session data
$_SESSION = [];

// destroy session cookie (extra safety)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// destroy session
session_destroy();

// redirect to home page
header("Location: Homepage.php");
exit;
?>