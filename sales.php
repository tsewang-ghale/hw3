<?php
require_once("util-db.php");
require_once("model-sales.php");
  
$pageTitle = "Sales";
include "view-header.php";

if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      insertSale($_POST['cid'],  $_POST ['saledate'], $_POST ['tax'], $_POST['shipping']); 
      break; 
  }
}

$sales = selectSales();
include "view-sales.php";
include "view-footer.php";
?>
