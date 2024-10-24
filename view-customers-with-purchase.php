<div class = "row">
  <div class = "col">
  <h1> Customers with Purchase</h1>
  </div>
  <div class = "col-auto">
<?php 
include "view-customers-with-purchase-newform1.php"; 
?>
  </div>
</div>

 <div class="card-group">
<?php
while ($customer= $customers -> fetch_assoc()){
?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $customer['cust_firstname'] ?>;<?php echo $customer['cust_lastname']; ?> </h5>
      <p class="card-text">
     <ul class="list-group">
  <?php
   $sales = selectCustomersPurchase($customer['cust_id']); 
  while ($sale= $sales -> fetch_assoc()){
  ?> 
        <li class="list-group-item"><?php echo($sale['cust_firstname']); ?>- <?php echo($sale['product_name']); ?>- <?php echo($sale['sale_date']); ?>- <?php echo($sale['saleprice']); ?></li>
  <?php 
  }
  ?>
      </ul>
      </p>
      <p class="card-text"><small class="text-body-secondary"> Phonenumber: <?php echo $customer['cust_phone']; ?>; Email:<?php echo $customer['cust_email']; ?> </small></p>
    </div>
  </div>
<?php
}
?>
</div>
