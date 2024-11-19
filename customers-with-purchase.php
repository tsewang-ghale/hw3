<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");
  
$pageTitle = "Customers with Purchase";
include "view-header.php";
$customers = selectCustomers();
include "view-customers-with-purchase.php";
include "view-footer.php";
?>
