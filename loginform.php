<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>
    <?php include "inc_navigation.php"; ?>

    <div class="content">
        <h2>Login</h2>

        <!-- Login Form -->
        <form action="logindisplay.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <input type="submit" value="Login" class="login-button">
        </form>

        <br> <!-- Added space between the two forms -->

        <!-- Create Login Form -->
        <form action="logindisplay.php" method="post">
            <label for="newUsername">New Username:</label>
            <input type="text" name="username" id="newUsername" required><br><br>

            <label for="newPassword">New Password:</label>
            <input type="password" name="password" id="newPassword" required><br><br>

            <input type="submit" name="create" value="Create Login">
        </form>
    </div>

    <?php include "inc_footer.php"; ?>
</body>
</html>
