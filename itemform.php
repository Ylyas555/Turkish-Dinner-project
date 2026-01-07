<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Form</title>
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
        $name = $price = $category = "";
        $available = "";
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['name'])) {
                $errors['name'] = "Item name is required.";
            } else {
                $name = htmlspecialchars($_POST['name']);
            }

            if (empty($_POST['price'])) {
                $errors['price'] = "Price is required.";
            } elseif (!is_numeric($_POST['price'])) {
                $errors['price'] = "Price must be a number.";
            } else {
                $price = $_POST['price'];
            }

            if (empty($_POST['category'])) {
                $errors['category'] = "Category must be selected.";
            } else {
                $category = $_POST['category'];
            }

            $available = isset($_POST['available']) ? "Yes" : "No";

            if (empty($errors)) {
                echo "<h3>Form Accepted</h3>";
                echo "<p><strong>Item Name:</strong> $name</p>";
                echo "<p><strong>Price:</strong> $price</p>";
                echo "<p><strong>Category:</strong> $category</p>";
                echo "<p><strong>Available:</strong> $available</p>";
                echo "<hr>";

                // Clear form values after successful submission
                $name = $price = $category = $available = "";
            }
        }
        ?>

        <form action="" method="post">
            <label for="name">Item Name:</label>
            <input type="text" name="name" id="name" value="<?= $name ?>">
            <span class="error"><?= $errors['name'] ?? "" ?></span><br>

            <label for="price">Price ($):</label>
            <input type="text" name="price" id="price" value="<?= $price ?>">
            <span class="error"><?= $errors['price'] ?? "" ?></span><br>

            <label>Category:</label>
            <input type="radio" name="category" value="Food" <?= ($category=="Food")?"checked":"" ?>>Food
            <input type="radio" name="category" value="Drink" <?= ($category=="Drink")?"checked":"" ?>>Drink
            <input type="radio" name="category" value="Dessert" <?= ($category=="Dessert")?"checked":"" ?>>Dessert
            <span class="error"><?= $errors['category'] ?? "" ?></span><br>

            <label>Available:</label>
            <input type="checkbox" name="available" <?= ($available=="Yes")?"checked":"" ?>><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>

    <?php include "inc_footer.php"; ?>
</body>
</html>
