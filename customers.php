<?php
require_once("util-db.php");
require_once("model-customers.php");
  
$pageTitle = "Customers";
include "view-header.php";
if (isset($_POST ['actionType'])){
  switch ($_POST ['actionType']) {
    case "Add": 
      if (insertCustomer($_POST['cust_firstname'],$_POST ['cust_lastname'], $_POST ['cust_address'], $_POST['cust_phone'],$_POST['cust_email'])) {
        echo '<div class="alert alert-success" role="alert"> Customer added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
    case "Edit": 
      if (UpdateCustomer($_POST['$cust_id'], $_POST['cust_firstname'], $_POST ['cust_lastname'], $_POST ['cust_address'], $_POST['cust_phone'],$_POST['cust_email'])) {
            echo '<div class="alert alert-success" role="alert"> Customer edited.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }

      break; 
    case "Delete":
      if (deleteCustomer($_POST['$cust_id'])) {
        echo '<div class="alert alert-success" role="alert"> Customer deleted.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}
$customers = selectCustomers();
include "view-customers.php";
include "view-footer.php";
?>
