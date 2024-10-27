<?php
require_once("util-db.php");
require_once("model-saleitems-by-sale.php");

$pageTitle = "SaleItems by Sale";
include "view-header.php";
$saleitems = selectSaleitemsBySale($_POST['lid']);
include "view-saleitems-by-sale.php";
include "view-footer.php";
?>
