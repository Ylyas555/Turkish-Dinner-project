<?php
// PART 2 — Navigation arrays
$navCaptions = ["Home", "Contacts", "Products", "Order Now"];
$navLinks    = ["index.php", "contact.php", "product.php", "order.php"];

echo "<nav>";
foreach ($navCaptions as $index => $caption) {
    echo "<a href='{$navLinks[$index]}'>$caption</a>";
}
echo "</nav>";
?>
