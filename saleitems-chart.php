<?php
require_once("util-db.php");
require_once("model-saleitems-chart.php");

$pageTitle = "Sale Items Chart";
include "view-header.php";

// Fetch sale items data
$saleitems = selectSaleItems();

// Debug: Check if sale items data is empty
if (!$saleitems || $saleitems->num_rows == 0) {
    echo "No sale items found.";
}

// Display chart
include "view-saleitems-chart.php";  // Display the chart
include "view-footer.php";
?>
