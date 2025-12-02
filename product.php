<?php
/*
    Ylyas Movlyamov
    Date: 12/01/2025
    Description: Turkish Dinner – Product List Page
                 I only created and updated product.php and general/style.css 
*/

/* --------------------------------------
    array containing product data
    each item includes Name, Price in dollars, Sidings for free, Wait-time-min
----------------------------------------- */
$products = [
    ["name" => "Kebap", "price" => 4, "siding" => "Bread and tea", "wait" => 20],
    ["name" => "Pide", "price" => 2, "siding" => "Tea", "wait" => 10],
    ["name" => "Doner", "price" => 3, "siding" => "Tea", "wait" => 7],
    ["name" => "Bakhlava", "price" => 1.5, "siding" => "Tea", "wait" => 3],
    ["name" => "Turkish coffee", "price" => 1, "siding" => "Sugar", "wait" => 10]
];

/* ---------------------------------------------------------
    navigation arrays (captions and links)
------------------------------------------------------- */
$navCaptions = ["Home", "Contacts", "Products", "Order Now"];
$navLinks    = ["index.php", "contact.php", "product.php", "order.php"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="general/style.css?v=1.0">

    <title>Products - Turkish Dinner</title>
</head>

<body>

<header>
    <h1>Our Turkish Menu</h1>
    <p>Fresh, delicious, and served with traditional sidings.</p>
</header>

<!-- ------------------------------------------------
     navigation built using the nav arrays
------------------------------------------------------ -->
<nav>
    <?php
        for ($i = 0; $i < count($navCaptions); $i++) {
            echo "<a href='{$navLinks[$i]}'>{$navCaptions[$i]}</a>";
        }
    ?>
</nav>

<!-- -----------------------------------------------------
      display food menu table
------------------------------------------------------ -->
<div class="content">
    <h2>Menu Items</h2>
    <p>Our traditional Turkish meals with prices and sidings:</p>

    <table class="product-table">
    <tr>
        <th>Name</th>
        <th>Price in dollars</th>
        <th>Sidings for free</th>
        <th>Wait-time-min</th>
    </tr>
    <?php
    foreach ($products as $item) {
        echo "<tr>";
        echo "<td>{$item['name']}</td>";
        echo "<td>{$item['price']}</td>";
        echo "<td>{$item['siding']}</td>";
        echo "<td>{$item['wait']}</td>";
        echo "</tr>";
    }
    ?>
</table>

</div>

</body>
</html>
