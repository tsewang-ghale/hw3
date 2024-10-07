<?php
require_once("util-db.php");
require_once("model-sales-made-by-customers.php");
  
$pageTitle = "Sales made by Customers";
include "view-header.php";
$courses = selectSalesByCustomer($_GET['id']);
include "view-sales-made-by-customer.php";
include "view-footer.php";
?>
