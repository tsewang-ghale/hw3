<?php
require_once("util-db.php");
require_once("model-sales.php");
  
$pageTitle = "Sales";
include "view-header.php";
$courses = selectSales();
include "view-sales.php";
include "view-footer.php";
?>
