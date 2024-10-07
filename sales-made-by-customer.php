<?php
require_once("util-db.php");
require_once("model-instructors-with-courses.php");
  
$pageTitle = "Sales made by Customers";
include "view-header.php";
$customers = selectCustomers();
include "view-sales-made-by-customers.php";
include "view-footer.php";
?>
