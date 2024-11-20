<?php
require_once("model-customers-with-purchase.php");\
$products = selectProducts(); 
$customer = selectCustomers(); // This fetches customers data
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customerPurchaseModal">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
  </svg>
  Add Customer with Purchase
</button>

<!-- Modal -->

<div class="modal fade" id="customerPurchaseModal" tabindex="-1" aria-labelledby="customerPurchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="customerPurchaseModalLabel">Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">        
          <!-- Customer Dropdown -->
          <div class="mb-3">
            <label for="cust_id" class="form-label">Customer:</label>
            <select name="cust_id" id="cust_id" class="form-control" required>
              <option value="">Select a Customer</option>
              <?php while ($customers = $customer->fetch_assoc()) { ?>
                <option value="<?php echo $customers['cust_id']; ?>">
                  <?php echo $customers['cust_firstname'] . " " . $customers['cust_lastname']; ?>
                </option>
              <?php } ?>
            </select>
          </div>
         <!-- Product Dropdown -->
          <div class="mb-3">
            <label for="product_id" class="form-label">Product:</label>
            <select name="product_id" id="product_id" class="form-control" required>
              <option value="">Select a Product</option>
              <?php while ($product = $products->fetch_assoc()) { ?>
                <option value="<?php echo $product['product_id']; ?>">
                  <?php echo $product['product_name']; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
          </div>

          <input type="hidden" name="actionType" value="AddPurchase">
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
