<?php
require_once("model-saleitems-chart.php");  // Include the file that contains selectSaleItems()

$pageTitle = "Sale Items Chart";
include "view-header.php";

// Fetch the sale items data
$saleitems = selectSaleItems();  // Now this function should be recognized

// Display the chart
include "view-saleitems-chart.php";  // Display the chart
include "view-footer.php";
?>
