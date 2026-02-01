<?php
session_start();
if (empty($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    echo "<p style='text-align:center; color:red; font-weight:bold;'>
            You are not logged in. Please <a href='login.php'>log in</a> to access this page.
          </p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Display</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>
<?php include "inc_header.php"; ?>
<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Order History</h2>

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
    die("<p style='color:red;'>Database connection failed: {$e->getMessage()}</p>");
}

/* ===============================
   JOIN QUERY
================================ */
$sql = "
    SELECT 
        orders.order_id,
        items.name AS item_name,
        orders.quantity,
        orders.cost,
        orders.order_date
    FROM orders
    JOIN items ON orders.item_id = items.item_id
    ORDER BY orders.order_date
";

$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($orders) === 0) {
    echo "<p>No orders found.</p>";
} else {
?>
    <table class="product-table">
        <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Cost ($)</th>
            <th>Date</th>
        </tr>

        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order["order_id"] ?></td>
            <td><?= htmlspecialchars($order["item_name"]) ?></td>
            <td><?= $order["quantity"] ?></td>
            <td><?= $order["cost"] ?></td>
            <td><?= $order["order_date"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php } ?>

</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
