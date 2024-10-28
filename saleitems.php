<?php
require_once("util-db.php");
require_once("model-saleitems.php");
 
$pageTitle = "Sale Items";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertSaleItem($_POST ['product_id'], $_POST ['sale_id'], $_POST['quantity'],$_POST['saleprice'] )) {
        echo '<div class="alert alert-success" role="alert"> Sale added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateSaleItem($_POST['saleitem_id'], $_POST['sale_id'], $_POST['quantity'], $_POST['saleprice'])) {
            echo '<div class="alert alert-success" role="alert"> Sale edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteSaleItem($_POST['saleitem_id'])) {
        echo '<div class="alert alert-success" role="alert"> SaleItem deleted.</div>'; 
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
