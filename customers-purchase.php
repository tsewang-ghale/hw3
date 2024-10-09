<?php
require_once("util-db.php");
require_once("model-customers-purchase.php");

$pageTitle = "Customers Purchases";
include "view-header.php";

// Check if customer ID is provided
if (isset($_GET['id'])) {
    $sales = selectCustomersPurchase($_GET['id']);
    include "view-customers-purchase.php";
} else {
    echo "<p>Error: No customer ID provided.</p>";
}

include "view-footer.php";
?>

