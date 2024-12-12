<?php
require_once("util-db.php");
require_once("model-sales.php");
  
$pageTitle = "Sales";
include "view-header.php";

// Handle different actions (Add, Edit, Delete)
if (isset($_POST['actionType'])) {
  switch ($_POST['actionType']) {
    case "Add": 
      // Add new sale
      if (insertSale($_POST['Cust_id'], $_POST['Sale_date'], $_POST['Tax'], $_POST['Shipping'])) {
        echo '<div class="alert alert-success" role="alert"> Sale added.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break; 
      
    case "Edit": 
      // Edit existing sale
     if (isset($_POST['sid']) && isset($_POST['Cust_id']) && isset($_POST['Sale_date']) && isset($_POST['Tax']) && isset($_POST['Shipping'])) {
    $sale_id = $_POST['sid'];
    $cust_id = $_POST['Cust_id']; // Pass cust_id to the UpdateSale function
    $sale_date = $_POST['Sale_date'];
    $tax = $_POST['Tax'];
    $shipping = $_POST['Shipping'];

    // Call the UpdateSale function with all parameters
    if (UpdateSale($sale_id, $cust_id, $sale_date, $tax, $shipping)) {
        echo '<div class="alert alert-success" role="alert"> Sale edited.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
    }
}

      break; 

    case "Delete":
      // Delete sale
      if (deleteSale($_POST['sale_id'])) {
        echo '<div class="alert alert-success" role="alert"> Sale deleted.</div>'; 
      } else {
        echo '<div class="alert alert-danger" role="alert"> Error.</div>';
      }
      break;
  }
}

// Retrieve all sales for display
$sales = selectSales();
include "view-sales.php";
include "view-footer.php";
?>
