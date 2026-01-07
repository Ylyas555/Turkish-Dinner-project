<?php
session_start(); // start session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Save to session
    $_SESSION['username'] = $username;
    $_SESSION['isLogin'] = true;
} else {
    // If accessed directly without form, redirect to login
    header("Location: loginform.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Display</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>
    <?php include "inc_navigation.php"; ?>

    <div class="content">
        <h2>Login Successful</h2>
        <p><strong>Username:</strong> <?= $_SESSION['username'] ?></p>
        <p><strong>Password:</strong> <?= $password ?></p>
        <p style="color:green; font-weight:bold;">You are now logged in!</p>
        <p><a href="index.php">Go to Home Page</a></p>
    </div>

    <?php include "inc_footer.php"; ?>
</body>
</html>
