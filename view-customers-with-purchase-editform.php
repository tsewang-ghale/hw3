<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerPurchaseModal<?php echo $customer['cust_id']; ?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
  </svg>
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerPurchaseModal<?php echo $customer['cust_id']; ?>" tabindex="-1" aria-labelledby="editCustomerPurchaseModalLabel<?php echo $customer['cust_id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCustomerPurchaseModalLabel<?php echo $customer['cust_id']; ?>"> Edit Customer with Purchase</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <!-- Dropdown to select customer -->
          <div class="mb-3">
            <label for="cust_id<?php echo $customer['cust_id']; ?>" class="form-label">Select Customer</label>
            <select class="form-control" id="cust_id<?php echo $customer['cust_id']; ?>" name="cust_id">
              <?php
              // Assuming you have a database connection already established
              $query = "SELECT cust_id, CONCAT(cust_firstname, ' ', cust_lastname) AS customer_name FROM customers";
              $result = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['cust_id']}'>{$row['customer_name']}</option>";
              }
              ?>
            </select>
          </div>
          <!-- Product and purchase details -->
          <div class="mb-3">
            <label for="product_name<?php echo $customer['cust_id']; ?>" class="form-label">Product Purchased</label>
            <input type="text" class="form-control" id="product_name<?php echo $customer['cust_id']; ?>" name="product_name" value="<?php echo $sale['product_name']; ?>">
          </div>
          <div class="mb-3">
            <label for="sale_date<?php echo $customer['cust_id']; ?>" class="form-label">Sale Date</label>
            <input type="date" class="form-control" id="sale_date<?php echo $customer['cust_id']; ?>" name="sale_date" value="<?php echo $sale['sale_date']; ?>">
          </div>
          <div class="mb-3">
            <label for="saleprice<?php echo $customer['cust_id']; ?>" class="form-label">Sale Price</label>
            <input type="text" class="form-control" id="saleprice<?php echo $customer['cust_id']; ?>" name="saleprice" value="<?php echo $sale['saleprice']; ?>">
          </div>
          <!-- Hidden fields for action type -->
          <input type="hidden" name="actionType" value="EditPurchase">
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
