<form method="post" action="add-customer-purchase.php" class="mb-3">
  <div class="form-group">
    <label for="customer_select">Select Customer</label>
    <select 
      id="customer_select" 
      name="cust_id" 
      class="form-control" 
      size="5" 
      required>
      <?php
      // Fetch customers for the dropdown
      while ($customer = $customers->fetch_assoc()) {
        echo "<option value='" . $customer['cust_id'] . "'>";
        echo $customer['cust_firstname'] . " " . $customer['cust_lastname'];
        echo "</option>";
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input 
      type="text" 
      id="product_name" 
      name="product_name" 
      class="form-control" 
      placeholder="Enter product name" 
      required>
  </div>
  <div class="form-group">
    <label for="sale_date">Sale Date</label>
    <input 
      type="date" 
      id="sale_date" 
      name="sale_date" 
      class="form-control" 
      required>
  </div>
  <div class="form-group">
    <label for="sale_price">Sale Price</label>
    <input 
      type="number" 
      step="0.01" 
      id="sale_price" 
      name="sale_price" 
      class="form-control" 
      placeholder="Enter sale price" 
      required>
  </div>
  <button type="submit" class="btn btn-primary">Add Purchase</button>
</form>
