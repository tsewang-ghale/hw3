<?php
require_once("util-db.php");
require_once("model-saleitems-chart.php");
  
$pageTitle = "Sale Items Chart";  // Title for the page
include "view-header.php";  // Include the header view
$saleitems = selectSaleItems()  // Fetch the sale items data using the selectSaleItems function
include "view-saleitems-chart.php";  // Include the chart view
include "view-footer.php";  // Include the footer view
?>
