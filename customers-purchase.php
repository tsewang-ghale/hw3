<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");

$pageTitle = "Customers Purchases";
include "view-header.php";

// Check if 'id' is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $customers = selectCustomersPurchase($_GET['id']);
} else {
    echo "Invalid or missing 'id' parameter.";
    exit;
}

include "view-customers-purchase.php";
include "view-footer.php";
?>
