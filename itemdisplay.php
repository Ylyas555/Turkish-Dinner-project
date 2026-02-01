<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
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
    <title>Item Display</title>
    <link rel="stylesheet" href="general/style.css">
</head>
<body>
<?php include "inc_header.php"; ?>
<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Find Item</h2>

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
   GET ALL ITEMS FOR DROPDOWN
================================ */
$itemList = $pdo->query("SELECT item_id, name FROM items")
                ->fetchAll(PDO::FETCH_ASSOC);

$selectedItem = "";
$itemData = null;

/* ===============================
   FORM SUBMIT
================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedItem = $_POST["item_id"];

    $stmt = $pdo->prepare(
        "SELECT * FROM items WHERE item_id = :item_id"
    );
    $stmt->execute([":item_id" => $selectedItem]);
    $itemData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="post">
    <label>Select Item:</label><br>
    <select name="item_id" required>
        <option value="">-- Choose an item --</option>
        <?php foreach ($itemList as $item): ?>
            <option value="<?= $item["item_id"] ?>"
                <?= ($selectedItem == $item["item_id"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($item["name"]) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <input type="submit" value="Display Item">
</form>

<hr>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>

    <?php if ($itemData): ?>
        <h3>Item Details</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($itemData["name"]) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($itemData["price"]) ?></p>
        <p><strong>Category:</strong> <?= htmlspecialchars($itemData["category"]) ?></p>
        <p><strong>Available:</strong> <?= htmlspecialchars($itemData["available"]) ?></p>
    <?php else: ?>
        <p style="color:red;">Item not found.</p>
    <?php endif; ?>

<?php endif; ?>

</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
