<?php
require_once("util-db.php");
require_once("model-sales.php");

$pageTitle = "Sales Chart"; // Title of the page
include "view-header.php";  // Header part

// Fetch sales data from the database
$sales = selectSales();

// Arrays to hold sales data and customer names for the chart
$saleData = [];
$customerNames = [];

while ($sale = $sales->fetch_assoc()) {
    // Store the customer name and the count of sales per customer
    $customerNames[] = $sale['cust_id']; // Assuming 'cust_id' represents the customer ID
    $saleData[] = (int) $sale['Sale_id']; // Assuming 'sale_id' represents an individual sale
}

include "view-sales-chart.php"; // Include the chart view
include "view-footer.php"; // Footer part
?>
