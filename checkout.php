<?php
require_once "classes/Order.php";
session_start();

/* ===============================
   CHECK ORDER OBJECT
================================ */
if (!isset($_SESSION["order"])) {
    echo "<p style='color:red; font-weight:bold; text-align:center;'>
            No order found. Please make an order first.
          </p>";
    exit();
}

$order = $_SESSION["order"];

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
    die("Database connection failed.");
}

/* ===============================
   INSERT ORDER
================================ */
$stmt = $pdo->prepare(
    "INSERT INTO orders (item_id, quantity, cost, order_date)
     VALUES (?, ?, ?, NOW())"
);

$stmt->execute([
    $order->getItemId(),
    $order->getQuantity(),
    $order->getCost()
]);

// Clear session order
unset($_SESSION["order"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>

<?php include "inc_header.php"; ?>
<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Order Placed Successfully</h2>

    <p><strong>Item:</strong> <?= htmlspecialchars($order->getItemName()) ?></p>
    <p><strong>Quantity:</strong> <?= $order->getQuantity() ?></p>
    <p><strong>Total Cost:</strong> $<?= $order->getCost() ?></p>

    <p style="color:green; font-weight:bold;">
        Your order has been placed successfully!
    </p>

    <p><a href="orderdisplay.php">View Order History</a></p>
</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
