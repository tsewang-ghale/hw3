<h1> Customers with Purchases </h1>
<div class="card-group">
<?php
while ($customer = $customers->fetch_assoc()) {
?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $customer['cust_firstname'] . " " . $customer['cust_lastname']; ?></h5>
      <p class="card-text">
        <ul class="list-group">
          <?php
          // Fetch sales for this customer
          $sales = selectCustomersWithPurchase($customer['cust_id']);
          if ($sales->num_rows > 0) {
            while ($sale = $sales->fetch_assoc()) {
          ?>
              <li class="list-group-item">
                <?php echo $sale['product_name']; ?> - 
                <?php echo $sale['sale_date']; ?> - 
                $<?php echo number_format($sale['saleprice'], 2); ?>
              </li>
          <?php
            }
          } else {
            echo '<li class="list-group-item">No purchases</li>';
          }
          ?>
        </ul>
      </p>
      <p class="card-text">
        <small class="text-body-secondary">
          Phone: <?php echo $customer['cust_phone']; ?> <br>
          Email: <?php echo $customer['cust_email']; ?>
        </small>
      </p>
    </div>
  </div>
<?php
}
?>
</div>
