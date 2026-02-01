<?php
// Function to display today's date
function todaysDate() {
    return date("F j, Y");
}
?>

<header>
    <h1>Welcome to Turkish Dinner</h1>
    <p><strong><?php echo todaysDate(); ?></strong></p>
</header>
