<h1> Customers with Purchase</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
    Add Customer
</button>

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
          $sales = selectCustomersPurchase($customer['cust_id']);
          while ($sale = $sales->fetch_assoc()) {
        ?>
          <li class="list-group-item">
            <?php echo($sale['cust_firstname']); ?> - 
            <?php echo($sale['product_name']); ?> - 
            <?php echo($sale['sale_date']); ?> - 
            <?php echo($sale['saleprice']); ?>
          </li>
        <?php 
          }
        ?>
        </ul>
      </p>
      <p class="card-text"><small class="text-body-secondary"> 
        Phone: <?php echo $customer['cust_phone']; ?>; 
        Email: <?php echo $customer['cust_email']; ?> 
      </small></p>
    </div>
  </div>
<?php
}
?>
</div>

<!-- Modal for Adding Customer -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="handle-add-customer.php"> <!-- Replace with appropriate handler -->
        <div class="modal-body">
          <div class="mb-3">
            <label for="cust_firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="cust_firstname" name="cust_firstname" required>
          </div>
          <div class="mb-3">
            <label for="cust_lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="cust_lastname" name="cust_lastname" required>
          </div>
          <div class="mb-3">
            <label for="cust_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="cust_address" name="cust_address">
          </div>
          <div class="mb-3">
            <label for="cust_phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="cust_phone" name="cust_phone">
          </div>
          <div class="mb-3">
            <label for="cust_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="cust_email" name="cust_email">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Customer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
