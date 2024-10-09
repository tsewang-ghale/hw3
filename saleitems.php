<?php
require_once("util-db.php");
require_once("model-saleitems.php");
  
$pageTitle = "Sale Items";
include "view-header.php";
$saleitems = selectSaleItems();
include "view-saleitems.php";
include "view-footer.php";
?>
