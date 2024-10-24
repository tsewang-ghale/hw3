<div class = "row">
  <div class = "col">
  <h1> Customers with Purchase</h1>
  </div>
  <div class = "col-auto">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
       <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
       <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
     </svg>
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
