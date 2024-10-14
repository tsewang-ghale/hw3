<h1> Customers with Purchase</h1>
 <div class="card-group">
<?php
while ($customer= $customers -> fetch_assoc()){
?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $customer['cust_firstname']; ?>,<?php echo $customer['cust_lastname']; ?> </h5>
      <p class="card-text">
  <?php
   $sales = SelectCustomersWithPurchase($customer['cust_id']); 
  while ($sale= $sales -> fetch_assoc()){
  ?> 
    
  <?php 
  }
  ?>
      </p>
      <p class="card-text"><small class="text-body-secondary"> Phonenumber: <?php echo $customer['cust_phone']; ?>,Email:<?php echo $customer['cust_email']; ?> </small></p>
    </div>
  </div>
<?php
}
?>
</div>
