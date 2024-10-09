<?php
require_once("util-db.php");
require_once("model-customers-purchase.php");

$pageTitle = "Customers Purchases";
include "view-header.php";

// Check if 'id' is set in the query parameters before using it
if (isset($_GET['id'])) {
    $sales = selectCustomersPurchase($_GET['id']);
} else {
    // Handle the case where 'id' is not set (e.g., display an error message or provide a default behavior)
    echo "<p>Error: No customer ID provided.</p>";
    $sales = []; // Initialize $sales as an empty array to avoid undefined variable error in 'view-customers-purchase.php'
}

include "view-customers-purchase.php";
include "view-footer.php";
?>

