<?php
require_once("util-db.php");
require_once("model-products-chart.php");

$pageTitle = "Product Sales Chart";  // Set the page title
include "view-header.php";  // Include the header
$products = selectProducts();  // Fetch the products data
include "view-products-chart.php";  // Display the chart view
include "view-footer.php";  // Include the footer
?>
