<?php
require_once("util-db.php");
require_once("model-saleitems.php");
  
$pageTitle = "Sale Items";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertSaleItem($_POST['Cust_id'],$_POST ['Sale_date'], $_POST ['Tax'], $_POST['Shipping'])) {
        echo '<div class="alert alert-success" role="alert"> Sale added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateSaleItem($_POST['sid'], $_POST['Sale_date'], $_POST['Tax'], $_POST['Shipping'])) {
            echo '<div class="alert alert-success" role="alert"> Sale edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteSaleItem($_POST['sale_id'])) {
        echo '<div class="alert alert-success" role="alert"> Sale deleted.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}
$saleitems = selectSaleItems();
include "view-saleitems.php";
include "view-footer.php";
?>
