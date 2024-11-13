<?php
require_once("util-db.php");
require_once("model-customers-chart.php");
  
$pageTitle = "Customers Chart";
include "view-header.php";
$customers = selectCustomers();
include "view-customers-chart.php";
include "view-footer.php";
?>
