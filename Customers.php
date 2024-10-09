<?php
require_once("util-db.php");
require_once("model-Customers.php");
  
$pageTitle = "Customers";
include "view-header.php";
$instructors = selectCustomers();
include "view-Customers.php";
include "view-footer.php";
?>
