<?php
require_once("util-db.php");
require_once("model-customers.php");
  
$pageTitle = "Customers";
include "view-header.php";
$instructors = selectCustomers();
include "view-customers.php";
include "view-footer.php";
?>
