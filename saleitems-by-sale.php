<?php
require_once("util-db.php");
require_once("model-saleitems-by-sale.php");
  
$pageTitle = "Saleitems by Sale";
include "view-header.php";
$sections = selectSaleitemssBySale($_POST['cid']);
include "view-saleitems-by-sale.php";
include "view-footer.php";
?>
