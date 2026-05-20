<?php
// Session memory allows us to store information between each page 
// for the life of the session
// session_start() says you want to use sessions in the screen

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session at the very beginning
}

require_once __DIR__ . '/../model/User.php'; // Required for unserializing User object in session

$forceLogin = FALSE;
$user = NULL;
$sessionTimeout = 1800;
$currentTime = time();
IF (!isset($_SESSION["LastActivity"])) {
    $_SESSION["LastActivity"] = $currentTime;
}
$lastActivityTime = $_SESSION["LastActivity"];

// Check if 
if (!isset($_SESSION['user'])) {
    $forceLogin = TRUE;
} else {
    // Check if the difference between now and last activity exceeds the timeout
    if (($currentTime - $lastActivityTime) > $sessionTimeout) {
        $forceLogin  = TRUE;
        session_unset();
        session_destroy();
    } else {
        $_SESSION["LastActivity"] = $currentTime;
        $user = unserialize($_SESSION['user']);
    }
}