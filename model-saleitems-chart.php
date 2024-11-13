<?php

require_once("util-db.php"); // Include your DB connection

function selectSaleItems() {
    // Example query to get sale items from the database
    $query = "SELECT item_id, SUM(quantity) AS total_quantity, SUM(total_price) AS total_price FROM saleitems GROUP BY item_id";
    $result = mysqli_query($GLOBALS['db'], $query); // Assuming you have a global db connection variable
    if (!$result) {
        die('Query failed: ' . mysqli_error($GLOBALS['db']));
    }
    return $result;
}
?>
