<?php
session_start(); // start session

if (!empty($_SESSION['isLogin']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<p style='text-align:center; font-weight:bold; color:green;'>
            Welcome back, $username!
          </p>";
} else {
    echo "<p style='text-align:center; color:red; font-weight:bold;'>
            You are not logged in. Please log in to continue.
          </p>";
}
?>
