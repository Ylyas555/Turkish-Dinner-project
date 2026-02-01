<?php
/*
    Ylyas Movlyamov
    CIS 334 – Unit 9
    Description: Display products from database
*/
session_start();
if (empty($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    echo "<p style='text-align:center; color:red; font-weight:bold;'>
            You are not logged in. Please <a href='loginform.php'>log in</a> to access this page.
          </p>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Turkish Dinner</title>
    <link rel="stylesheet" href="general/style.css">
</head>

<body>

<header>
    <h1>Our Turkish Menu</h1>
    <p>Fresh, delicious, and served daily.</p>
</header>


<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Menu Items</h2>

<?php
/* ===============================
   DATABASE CONNECTION
================================ */
$host = "127.0.0.1";
$dbname = "ymdatabase";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<p style='color:red;'>Database connection failed: " . $e->getMessage() . "</p>");
}

/* ===============================
   SELECT ITEMS
================================ */
$sql = "SELECT item_id, name, price, category, available FROM items";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($items) === 0) {
    echo "<p>No items found.</p>";
} else {
?>
    <table class="product-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price ($)</th>
            <th>Category</th>
            <th>Available</th>
        </tr>

        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item["item_id"]) ?></td>
            <td><?= htmlspecialchars($item["name"]) ?></td>
            <td><?= htmlspecialchars($item["price"]) ?></td>
            <td><?= htmlspecialchars($item["category"]) ?></td>
            <td><?= htmlspecialchars($item["available"]) ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
<?php } ?>

</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
