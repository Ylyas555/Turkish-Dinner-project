<?php
session_start();

// Initialize login success flag
$loginSuccess = false;
$isCreating = false;

// Check if the "create" button is pressed (for new user creation)
if (isset($_POST['create'])) {
    $newUsername = trim($_POST['username']);
    $newPassword = trim($_POST['password']);

    // Open password.txt to add new user
    $file = fopen("password.txt", "a");
    if ($file) {
        // Add the new user and password
        fwrite($file, "\n" . $newUsername . "," . $newPassword);
        fclose($file);
        echo "<p>Account created successfully. You are now logged in!</p>";
        $loginSuccess = true;
        $_SESSION['username'] = $newUsername;
        $_SESSION['isLogin'] = true;
    } else {
        echo "<p style='color:red;'>Error creating account.</p>";
    }
} else {
    // Proceed with login process if "create" button was not pressed
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user input
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Read password.txt into an array
        $lines = file("password.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Loop through file to validate login
        foreach ($lines as $line) {
            list($fileUser, $filePass) = array_map('trim', explode(",", $line));

            if ($username === $fileUser && $password === $filePass) {
                $loginSuccess = true;
                break;
            }
        }

        // Store login result in session
        if ($loginSuccess) {
            $_SESSION['username'] = $username;
            $_SESSION['isLogin'] = true;
        } else {
            $_SESSION['isLogin'] = false;
        }
    }
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

    <!-- content -->
    <div class="content">
        <?php if ($loginSuccess): ?>
            <h2>Login Successful</h2>
            <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
            <p style="color:green; font-weight:bold;">You are now logged in!</p>
            <p><a href="index.php">Go to Home Page</a></p>
        <?php else: ?>
            <h2>Login Failed</h2>
            <p style="color:red; font-weight:bold;">Invalid username or password.</p>
            <p><a href="loginform.php">Try Again</a></p>
        <?php endif; ?>
    </div>
    <!-- end -->

    <?php include "inc_footer.php"; ?>
</body>
</html>
