<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerWithPurchaseModal<?php echo $sale['sale_id'];?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
      </svg>
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerWithPurchaseModal<?php echo $sale['sale_id']; ?>" tabindex="-1" aria-labelledby="editCustomerWithPurchaseLabel<?php echo $sale['sale_id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCustomerWithPurchaseLabel<?php echo $sale['sale_id']; ?>"> Edit Sale</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <!-- Sale Information -->
          <div class="mb-3">
            <label for="Cust_ID<?php echo $sale['sale_id'];?>" class="form-label">Customer ID</label>
            <input type="Integer" class="form-control" id="cid<?php echo $sale['sale_id']; ?>" name="Cust_id" value="<?php echo $sale['cust_id']; ?>">
          </div>
          <div class="mb-3">
            <label for="Sale_Date<?php echo $sale['sale_id']; ?>" class="form-label">Sale Date</label>
            <input type="date" class="form-control" id="saledate<?php echo $sale['sale_id']; ?>" name="Sale_date" value="<?php echo $sale['sale_date']; ?>">
          </div>
          <div class="mb-3">
            <label for="tax<?php echo $sale['sale_id']; ?>" class="form-label">Tax</label>
            <input type="Integer" class="form-control" id="tax<?php echo $sale['sale_id']; ?>" name="Tax" value="<?php echo $sale['tax']; ?>">
          </div>
          <div class="mb-3">
            <label for="shipping<?php echo $sale['sale_id']; ?>" class="form-label">Shipping</label>
            <input type="Integer" class="form-control" id="shipping<?php echo $sale['sale_id']; ?>" name="Shipping" value="<?php echo $sale['shipping']; ?>">
          </div>

          <!-- Sale Items -->
          <h5>Sale Items</h5>
          <?php 
            // Fetch SaleItem details for this sale
            $query = "SELECT `SaleItem`.`SaleItem_id`, `SaleItem`.`quantity`, `SaleItem`.`saleprice`, `Product`.`listprice` FROM `SaleItem` 
                      JOIN `Product` ON `SaleItem`.`product_id` = `Product`.`product_id`
                      WHERE `SaleItem`.`sale_id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $sale['sale_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($saleItem = $result->fetch_assoc()) {
                $SaleItem_id = $saleItem['SaleItem_id'];
                $quantity = $saleItem['quantity'];
                $saleprice = $saleItem['saleprice'];
                $listprice = $saleItem['listprice'];
          ?>
          <div class="mb-3">
            <label for="quantity<?php echo $SaleItem_id; ?>" class="form-label">Quantity for Product <?php echo $SaleItem_id; ?></label>
            <input type="number" class="form-control" id="quantity<?php echo $SaleItem_id; ?>" name="quantity[<?php echo $SaleItem_id; ?>]" value="<?php echo $quantity; ?>">
          </div>
          <div class="mb-3">
            <label for="saleprice<?php echo $SaleItem_id; ?>" class="form-label">Sale Price for Product <?php echo $SaleItem_id; ?></label>
            <input type="number" class="form-control" id="saleprice<?php echo $SaleItem_id; ?>" name="saleprice[<?php echo $SaleItem_id; ?>]" value="<?php echo $saleprice; ?>" readonly>
          </div>
          <?php } ?>
          
          <input type="hidden" name="sid" value="<?php echo $sale['sale_id']; ?>">
          <input type="hidden" name="actionType" value="Edit"> 
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
