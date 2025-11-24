<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="general/style.css">

    <title>Turkish Dinner</title>
    
</head>

<body>

<?php
// Simple PHP function to display today's date
// F - Full month name
// j - Day of the month without leading zeros
// Y - Four digit year
function todaysDate() {
    return date("F j, Y");
}
?>

<header>
    <h1>Welcome to Turkish Dinner</h1>
    <p> <strong><?php echo todaysDate(); ?></strong></p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="contacts.php">Contacts</a>
    <a href="product.php">Product</a>
    <a href="order.php">Order Now</a>
</nav>

<div class="content">
    <h2>Authentic Turkish Food Experience</h2>
    <p>Enjoy delicious traditional Turkish meals, prepared with love and rich flavors.</p>
        <div class="image-row">
            <img src="image/turkish-food.jpg" alt="Turkish Dinner Image">
            <img src="image/turkish-seafood.jpg" alt="Turkish Seafood Image">
            <img src="image/turkish-dessert.jpg" alt="Turkish Dessert Image">
        </div>
        </div>

</body>
</html>
