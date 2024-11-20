<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");

require_once("model-sales.php");

  
$pageTitle = "Customers with Purchase";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "AddPurchase": 
      if (InsertCustomersWithPurchase($_POST['product_id'],$_POST ['cust_id'],$_POST['sale_date'], $_POST['quantity'], $_POST['tax'], $_POST['shipping'])) {
        echo '<div class="alert alert-success" role="alert"> Customer added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateCustomersWithPurchase($_POST['sid'],$_POST['Cust_id'], $_POST['Sale_date'], $_POST ['Tax'], $_POST['Shipping'],$_POST['quantity'])) {
            echo '<div class="alert alert-success" role="alert"> Customer edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteCustomersWithPurchase($_POST['sale_id'])) {
        echo '<div class="alert alert-success" role="alert"> Customer deleted.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}
$customers = selectCustomers();
$sales = selectSales();
include "view-customers-with-purchase.php";
include "view-footer.php";
?>
