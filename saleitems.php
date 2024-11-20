<?php
require_once("util-db.php");
require_once("model-saleitems.php");
 
$pageTitle = "Sale Items";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertSaleItems($_POST ['product_id'], $_POST ['sale_id'], $_POST['quantity'],$_POST['saleprice'] )) {
        echo '<div class="alert alert-success" role="alert"> SaleItem added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (updateSaleItems($_POST['Saleitem_id'], $_POST['product_id'], $_POST['sale_id'], $_POST['quantity'])) {
            echo '<div class="alert alert-success" role="alert"> SalItem edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteSaleItems($_POST['Saleitem_id'])) {
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
