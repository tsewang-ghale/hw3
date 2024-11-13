<?php
// This file handles database interaction

function selectSaleItems() {
    global $db;  // Assuming you have a database connection in $db

    $query = "SELECT item_name, COUNT(*) AS count_saleitem FROM saleitems GROUP BY item_name";
    $result = $db->query($query);

    if (!$result) {
        die("Query failed: " . $db->error);
    }

    return $result;
}
?>

