<?php
require_once("util-db.php");
require_once("model-customers-purchase.php");

$pageTitle = "Customers Purchases";
include "view-header.php";
$customers = selectCustomersPurchase($_GET['$Sale_id']);
include "view-customers-purchase.php";
include "view-footer.php";
?>

