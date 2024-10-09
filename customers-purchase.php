<?php
require_once("util-db.php");
require_once("model-customers-purchase.php");
  
$pageTitle = "Customers Purchases";
include "view-header.php";
$sales = selectCustomersPurchase($_GET['sid']);
include "view-customers-purchase.php";
include "view-footer.php";
?>
