<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");

$pageTitle = "Customers Purchases";
include "view-header.php";
$customers = selectCustomersPurchase($_GET['id']);
include "view-customers-purchase.php";
include "view-footer.php";
?>

