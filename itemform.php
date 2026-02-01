<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="general/style.css">
    <style>
        .error { color: red; }
        input, select { margin-bottom: 10px; }
    </style>
</head>
<body>

<?php include "inc_navigation.php"; ?>

<div class="content">
    <h2>Add Item</h2>

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
    die("<p class='error'>Database connection failed: " . $e->getMessage() . "</p>");
}

/* ===============================
   FORM VARIABLES
================================ */
$name = $price = $category = "";
$available = "No";
$errors = [];
$successMessage = "";

/* ===============================
   FORM SUBMISSION
================================ */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Item name
    if (empty($_POST["name"])) {
        $errors["name"] = "Item name is required.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Price
    if (empty($_POST["price"])) {
        $errors["price"] = "Price is required.";
    } elseif (!is_numeric($_POST["price"])) {
        $errors["price"] = "Price must be numeric.";
    } else {
        $price = $_POST["price"];
    }

    // Category
    if (empty($_POST["category"])) {
        $errors["category"] = "Category is required.";
    } else {
        $category = $_POST["category"];
    }

    // Available
    $available = isset($_POST["available"]) ? "Yes" : "No";

    /* ===============================
       INSERT INTO DATABASE
    ================================ */
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO items (name, price, category, available)
                    VALUES (:name, :price, :category, :available)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":name" => $name,
                ":price" => $price,
                ":category" => $category,
                ":available" => $available
            ]);

            $successMessage = "Item successfully added to database.";

            // Clear form
            $name = $price = $category = "";
            $available = "No";

        } catch (PDOException $e) {
            echo "<p class='error'>Database error: {$e->getMessage()}</p>";
        }
    }
}
?>

<!-- ===============================
     SUCCESS MESSAGE
================================ -->
<?php if ($successMessage): ?>
    <p style="color:green; font-weight:bold;">
        <?= $successMessage ?>
    </p>
<?php endif; ?>

<!-- ===============================
     FORM
================================ -->
<form method="post">

    <label>Item Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <span class="error"><?= $errors["name"] ?? "" ?></span><br>

    <label>Price ($):</label><br>
    <input type="text" name="price" value="<?= htmlspecialchars($price) ?>">
    <span class="error"><?= $errors["price"] ?? "" ?></span><br>

    <label>Category:</label><br>
    <input type="radio" name="category" value="Food" <?= ($category=="Food")?"checked":"" ?>> Food
    <input type="radio" name="category" value="Drink" <?= ($category=="Drink")?"checked":"" ?>> Drink
    <input type="radio" name="category" value="Dessert" <?= ($category=="Dessert")?"checked":"" ?>> Dessert
    <span class="error"><?= $errors["category"] ?? "" ?></span><br><br>

    <label>
        <input type="checkbox" name="available" <?= ($available=="Yes")?"checked":"" ?>>
        Available
    </label><br><br>

    <input type="submit" value="Add Item">

</form>

</div>

<?php include "inc_footer.php"; ?>

</body>
</html>
