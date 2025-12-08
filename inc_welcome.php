<?php
// PART 1
$isLogin = true;     // change to true if user logs in
$username = "Ylyas";    

if ($isLogin === true && $username !== null) {
    echo "<p style='text-align:center; font-weight:bold; color:green;'>
            Welcome back, $username!
          </p>";
} else {
    echo "<p style='text-align:center; color:red; font-weight:bold;'>
            You are not logged in. Please log in to continue.
          </p>";
}
?>
