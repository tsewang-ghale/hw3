<?php
require_once("util-db.php");
require_once("model-saleitems.php");
  
$pageTitle = "Sale Items";
include "view-header.php";
$sections = selectSaleItems();
include "view-saleitems.php";
include "view-footer.php";
?>
