<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");

require_once("model-sales.php");

  
$pageTitle = "Customers with Purchase";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (InsertCustomersWithPurchase($_POST['cust_firstname'],$_POST ['cust_lastname'],$_POST['cust_phone'],$_POST['cust_email'])) {
        echo '<div class="alert alert-success" role="alert"> Customer added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateCustomersWithPurchase($_POST['$Cust_id'], $_POST['cust_firstname'], $_POST ['cust_lastname'], $_POST['cust_phone'],$_POST['cust_email'])) {
            echo '<div class="alert alert-success" role="alert"> Customer edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteCustomersWithPurchase($_POST['$cust_id'])) {
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
