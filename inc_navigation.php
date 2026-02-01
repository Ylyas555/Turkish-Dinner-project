<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Navigation items
$navCaptions = ["Home", "Contacts", "Products", "Find Item", "Order History", "Add Item"];
$navLinks    = ["index.php", "contact.php", "product.php", "itemdisplay.php", "ordersdisplay.php", "add_item.php"];

// Begin nav
echo "<nav>";

// Display main links
foreach ($navCaptions as $index => $caption) {
    echo "<a href='{$navLinks[$index]}'>$caption</a> ";
}

// Display login/logout link based on session
if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
    echo "| <a href='login.php?action=logout'>Logout</a>";
} else {
    echo "| <a href='login.php'>Login / Register</a>";
}

echo "</nav>";
?>
