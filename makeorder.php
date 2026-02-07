<?php
require_once "classes/Order.php";
session_start();


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
   GET AVAILABLE ITEMS
================================ */
$items = $pdo->query(
    "SELECT item_id, name, price FROM items WHERE available = 'Yes'"
)->fetchAll(PDO::FETCH_ASSOC);

$error = "";
$success = "";

/* ===============================
   FORM HANDLER (SELF-CALL)
================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $item_id = $_POST["item_id"] ?? "";
    $quantity = $_POST["quantity"] ?? "";

    if ($item_id == "" || $quantity == "") {
        $error = "All fields are required.";
    } elseif (!is_numeric($quantity) || $quantity <= 0) {
        $error = "Quantity must be a positive number.";
    } else {

        // Verify item exists
        $stmt = $pdo->prepare(
            "SELECT name, price FROM items WHERE item_id = ? AND available = 'Yes'"
        );
        $stmt->execute([$item_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            $error = "Selected item is not available.";
        } else {
            // Create Order Object
            $order = new Order(
                $item_id,
                $item["name"],
                $quantity,
                $item["price"]
            );

            // Store object in session
            $_SESSION["order"] = $order;

            $success = "Item is on order!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Order</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>

<?php include "inc_header.php"; ?>
<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Place an Order</h2>

    <?php if ($error): ?>
        <p style="color:red; font-weight:bold;"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green; font-weight:bold;"><?= $success ?></p>
        <p><a href="checkout.php">Proceed to Checkout</a></p>
    <?php endif; ?>

    <form method="post">
        <label>Select Item:</label><br>
        <select name="item_id" required>
            <option value="">-- Select --</option>
            <?php foreach ($items as $item): ?>
                <option value="<?= $item["item_id"] ?>">
                    <?= htmlspecialchars($item["name"]) ?> ($<?= $item["price"] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1" required>
        <br><br>

        <input type="submit" value="Make Order">
    </form>
</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
