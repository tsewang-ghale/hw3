<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php"); // Updated to include the appropriate model for purchase data
  
$pageTitle = "Customers with Purchase";
include "view-header.php"; // Include the header file for consistent styling and structure

// Fetch customers with purchase details
$customers = selectCustomersWithPurchase(); // Ensure this function is implemented in model-customers-with-purchase.php

// Include the view to display customers with purchase details
include "view-customers-with-purchase.php";

// Include footer for consistent page structure
include "view-footer.php";
?>
