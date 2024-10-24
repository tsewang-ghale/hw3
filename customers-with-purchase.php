<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");
  
$pageTitle = "Customers with Purchase";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertSale($_POST['Cust_id'],$_POST['cust_firstname'], $_POST['cust_lastname'],$_POST ['product_name'], $_POST ['sale_date'], $_POST ['tax'], $_POST['shipping'], $_POST ['quantity'], $_POST ['saleprice'])) {
        echo '<div class="alert alert-success" role="alert"> Sale added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateSale($_POST['sid'], $_POST['custId'],$_POST['cust_firstname'], $_POST['cust_lastname'], $_POST['product_name'], $_POST['tax'], $_POST['shipping'], $_POST['quantity'], $_POST['saleprice'])) {
            echo '<div class="alert alert-success" role="alert"> Sale edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }
      break; 
    case "Delete":
      if (deleteSale($_POST['sid'])) {
        echo '<div class="alert alert-success" role="alert"> Sale deleted.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}

$customers = selectCustomers();
include "view-customers-with-purchase.php";
include "view-footer.php";
?>
