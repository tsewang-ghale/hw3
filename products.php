<?php
require_once("util-db.php");
require_once("model-products.php");
  
$pageTitle = "Products";
include "view-header.php";

if (isset($_POST ['actionType'])){
    switch ($_POST ['actionType']) {
      case "Add": 
        if (insertProduct($_POST['product_name'],$_POST ['product_description'], $_POST ['listprice'], $_POST['color'],$_POST['category'] )) {
          echo '<div class="alert alert-success" role="alert"> Product added.</div>'; 
        } else {
          echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }
        break; 
      case "Edit": 
        if (UpdateProduct($_POST['product_id'], $_POST['product_name'], $_POST['product_description'], $_POST['listprice'],$_POST['category']  )) {
              echo '<div class="alert alert-success" role="alert"> Product edited.</div>';
          } else {
              echo '<div class="alert alert-danger" role="alert"> Error.</div>';
          }
  
        break; 
      case "Delete":
        if (deleteProduct($_POST['product_id'])) {
          echo '<div class="alert alert-success" role="alert"> Product deleted.</div>'; 
        } else {
          echo '<div class="alert alert-danger" role="alert"> Error.</div>';
        }
        break;
    }
  }
$products = selectProducts();
include "view-products.php";
include "view-footer.php";
?>
