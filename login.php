<?php
session_start();

// handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

$message = "";
$loginSuccess = false;

// handle login
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $found = false;

    // check password.txt
    if (file_exists("password.txt")) {
        $lines = file("password.txt", FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            list($u, $p) = explode(",", $line);
            if ($username === trim($u) && $password === trim($p)) {
                $found = true;
                break;
            }
        }
    }

    // check enc_password.txt
    if (!$found && file_exists("enc_password.txt")) {
        $lines = file("enc_password.txt", FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            list($u, $p) = explode(",", $line);
            if ($username === trim($u) && $password === trim($p)) {
                $found = true;
                break;
            }
        }
    }

    if ($found) {
        $_SESSION['isLogin'] = true;
        $_SESSION['username'] = $username;
        $loginSuccess = true;
        $message = "Login successful!";
    } else {
        $message = "Invalid username or password.";
    }
}

// handle create account
if (isset($_POST['create'])) {
    $newUsername = trim($_POST['new_username']);
    $newPassword = trim($_POST['new_password']);
    if ($newUsername !== "" && $newPassword !== "") {
        file_put_contents("enc_password.txt", "$newUsername,$newPassword\n", FILE_APPEND);
        $message = "Account created. You can now log in!";
    } else {
        $message = "All fields are required to create account.";
    }
}

// date function
function todaysDate() {
    return date("F j, Y");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Create Account</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>

<header>
    <h1>Welcome to Turkish Dinner</h1>
    <p><strong><?php echo todaysDate(); ?></strong></p>
</header>

<?php include "inc_navigation.php"; ?>

<div class="content">

<?php if (!empty($message)): ?>
    <p style="color:red; font-weight:bold;"><?php echo $message; ?></p>
<?php endif; ?>

<?php if (empty($_SESSION['isLogin'])): ?>

    <h2>Login</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>

    <hr>

    <h2>Create New Account</h2>
    <form method="post">
        Username: <input type="text" name="new_username" required><br><br>
        Password: <input type="password" name="new_password" required><br><br>
        <input type="submit" name="create" value="Create Account">
    </form>

<?php else: ?>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You are logged in.</p>
    <p><a href="login.php?action=logout">Logout</a></p>

<?php endif; ?>

</div>

</body>
</html>
