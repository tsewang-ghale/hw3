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
            <label for="cust_firstname<?php echo $customer['cust_id']; ?>" class="form-label">First Name</label>
            <input type="text" class="form-control" id="cust_firstname<?php echo $customer['cust_id']; ?>" name="cust_firstname" value="<?php echo $customer['cust_firstname']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_lastname<?php echo $customer['cust_id']; ?>" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="cust_lastname<?php echo $customer['cust_id']; ?>" name="cust_lastname" value="<?php echo $customer['cust_lastname']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_address<?php echo $customer['cust_id']; ?>" class="form-label">Address</label>
            <input type="text" class="form-control" id="cust_address<?php echo $customer['cust_id']; ?>" name="cust_address" value="<?php echo $customer['cust_address']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_phone<?php echo $customer['cust_id']; ?>" class="form-label">Phone</label>
            <input type="text" class="form-control" id="cust_phone<?php echo $customer['cust_id']; ?>" name="cust_phone" value="<?php echo $customer['cust_phone']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_email<?php echo $customer['cust_id']; ?>" class="form-label">Email</label>
            <input type="text" class="form-control" id="cust_email<?php echo $customer['cust_id']; ?>" name="cust_email" value="<?php echo $customer['cust_email']; ?>">
          </div>
          <div class="mb-3">
            <label for="product_name<?php echo $customer['cust_id']; ?>" class="form-label">Product Purchased</label>
            <input type="text" class="form-control" id="product_name<?php echo $customer['cust_id']; ?>" name="product_name" value="<?php echo $sale['product_name']; ?>">
@@ -43,7 +48,7 @@
            <label for="saleprice<?php echo $customer['cust_id']; ?>" class="form-label">Sale Price</label>
            <input type="text" class="form-control" id="saleprice<?php echo $customer['cust_id']; ?>" name="saleprice" value="<?php echo $sale['saleprice']; ?>">
          </div>
          <!-- Hidden fields for action type -->
          <input type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>">
          <input type="hidden" name="actionType" value="EditPurchase">
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
