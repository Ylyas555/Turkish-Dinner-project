<?php
$conn = new mysqli("127.0.0.1", "root", "root", "ymdatabase");
if ($conn->connect_error) die("Database connection failed");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $price = trim($_POST["price"]);
    $category = trim($_POST["category"]);
    $available = trim($_POST["available"]);

    if ($name == "" || $price == "" || $category == "" || $available == "") {
        $error = "All fields are required.";
    } elseif (!is_numeric($price)) {
        $error = "Price must be numeric.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO items (name, price, category, available) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("sdss", $name, $price, $category, $available);
        if ($stmt->execute()) $success = "Item successfully added.";
        else $error = "Database insert error.";
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="general/style.css">
    <title>Admin - Add Item</title>
</head>
<body>


<?php include "inc_header.php"; ?>
<?php require_once "inc_navigation.php"; ?>

<div class="content">
    <h2>Add New Menu Item</h2>

    <?php
    if ($error) echo "<p style='color:red;'>$error</p>";
    if ($success) echo "<p style='color:green;'>$success</p>";
    ?>

    <form method="post">
        Name: <input type="text" name="name"><br><br>
        Price: <input type="text" name="price"><br><br>
         Category:
    <select name="category" required>
        <option value="">-- Select Category --</option>
        <option value="Food" <?= (isset($category) && $category=="Food") ? "selected" : "" ?>>Food</option>
        <option value="Drinks" <?= (isset($category) && $category=="Drinks") ? "selected" : "" ?>>Drinks</option>
        <option value="Dessert" <?= (isset($category) && $category=="Dessert") ? "selected" : "" ?>>Dessert</option>
    </select>
    <br><br>
        Available:
        <select name="available">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><br>
        <input type="submit" value="Add Item">
    </form>
</div>

</body>
</html>
