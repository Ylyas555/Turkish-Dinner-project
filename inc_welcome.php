<?php
/*
----------------------------------------------------
WELCOME MESSAGE
Uses:
- SESSION: isLogin (Boolean)
- COOKIE: username
----------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {

    // Get username from cookie
    $username = isset($_COOKIE['username'])
        ? htmlspecialchars($_COOKIE['username'])
        : "Guest";

    echo "<p style='text-align:center; font-weight:bold; color:green;'>
            Welcome back, $username!
          </p>";
} else {
    echo "<p style='text-align:center; color:red; font-weight:bold;'>
            You are not logged in. Please log in to continue.
          </p>";
}
?>
