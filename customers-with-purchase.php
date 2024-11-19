<?php
require_once("util-db.php");
require_once("model-customers-with-purchase.php");

$pageTitle = "Customers with Purchase";
include "view-header.php";

// Handle form actions
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case "Add":
            if (InsertCustomerWithPurchase($_POST['cust_firstname'], $_POST['cust_lastname'], $_POST['cust_address'], $_POST['cust_phone'], $_POST['cust_email'])) {
                echo '<div class="alert alert-success" role="alert"> Customer with purchase added.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert"> Error adding customer with purchase.</div>';
            }
            break;
        case "Edit":
            if (UpdateCustomerWithPurchase($_POST['cust_id'], $_POST['cust_firstname'], $_POST['cust_lastname'], $_POST['cust_address'], $_POST['cust_phone'], $_POST['cust_email'])) {
                echo '<div class="alert alert-success" role="alert"> Customer with purchase edited.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert"> Error editing customer with purchase.</div>';
            }
            break;
        case "Delete":
            if (DeleteCustomerWithPurchase($_POST['cust_id'])) {
                echo '<div class="alert alert-success" role="alert"> Customer with purchase deleted.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert"> Error deleting customer with purchase.</div>';
            }
            break;
    }
}

// Fetch customers
if (!function_exists('selectCustomersWithPurchase')) {
    die('Error: Function selectCustomersWithPurchase is not defined.');
}

$customers = selectCustomersWithPurchase();
include "view-customers-with-purchase.php";
include "view-footer.php";
?>
