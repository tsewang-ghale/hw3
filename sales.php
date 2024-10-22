<?php
require_once("util-db.php");
require_once("model-sales.php");
  
$pageTitle = "Sales";
include "view-header.php";

if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertSale($_POST['Cust_id'],  $_POST ['Sale_date'], $_POST ['Tax'], $_POST['Shipping'])) {
        echo '<div class="alert alert-success" role="alert"> Sale added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Delete":
      if (deleteSale($_POST['sid'])) {
        echo '<div class="alert alert-success" role="alert"> Sale deleted.</div>"'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}

$sales = selectSales();
include "view-sales.php";
include "view-footer.php";
?>
