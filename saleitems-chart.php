<?php
require_once("util-db.php");
require_once("model-saleitems-chart.php");
  
$pageTitle = "Sale Items Chart";
include "view-header.php";
$saleitems = selectSaleItems();  // Fetch the sale items data
include "view-saleitems-chart.php";  // Display the chart
include "view-footer.php";
?>
