<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerWithPurchaseModal<?php echo $customer['cust_id']; ?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
  </svg>
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerWithPurchaseModal<?php echo $customer['cust_id']; ?>" tabindex="-1" aria-labelledby="editCustomerWithPurchaseModalLabel<?php echo $customer['cust_id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCustomerWithPurchaseModalLabel<?php echo $customer['cust_id']; ?>">Edit customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="cust_id_<?php echo $customer['cust_id']; ?>" class="form-label">customer ID</label>
            <input type="number" class="form-control" id="cust_id_<?php echo $customer['cust_id']; ?>" name="cust_id" value="<?php echo $customer['cust_id']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_firstname_<?php echo $customer['cust_id']; ?>" class="form-label"> Customer First Name</label>
            <input type="text" class="form-control" id="cust_firstname_<?php echo $customer['cust_id']; ?>" name="cust_firstname" value="<?php echo $customer['cust_firstname']; ?>">
          </div>
          <div class="mb-3">
            <label for="cust_lastname_<?php echo $customer['cust_id']; ?>" class="form-label">customer Last Name </label>
            <input type="text" class="form-control" id="cust_lastname_<?php echo $customer['cust_id']; ?>" name="cust_lastname" value="<?php echo $customer['cust_lastname']; ?>">
          </div>
          <div class="mb-3">
            <label for="sale_date_<?php echo $customer['cust_id']; ?>" class="form-label"> Sale Date </label>
            <input type="date" class="form-control" id="sale_date_<?php echo $customer['cust_id']; ?>" name="sale_date" step="0.01" value="<?php echo $customer['sale_date']; ?>">
          </div>
        <div class="mb-3">
            <label for="tax_<?php echo $customer['cust_id']; ?>" class="form-label"> Tax </label>
            <input type="text" class="form-control" id="tax_<?php echo $customer['cust_id']; ?>" name="tax" value="<?php echo $customer['tax']; ?>">
          </div>
            <div class="mb-3">
            <label for="shipping_<?php echo $customer['cust_id']; ?>" class="form-label"> Shipping </label>
            <input type="text" class="form-control" id="shipping_<?php echo $customer['cust_id']; ?>" name="shipping" value="<?php echo $customer['shipping']; ?>">
          </div>
           <div class="mb-3">
            <label for="quantity_<?php echo $customer['cust_id']; ?>" class="form-label"> Quantity </label>
            <input type="text" class="form-control" id="quantity_<?php echo $customer['cust_id']; ?>" name="quantity" value="<?php echo $customer['quantity']; ?>">
          </div>
           <div class="mb-3">
            <label for="saleprice_<?php echo $customer['cust_id']; ?>" class="form-label"> Sale Price  </label>
            <input type="text" class="form-control" id="salepricey_<?php echo $customer['cust_id']; ?>" name="saleprice" value="<?php echo $customer['saleprice']; ?>">
          </div>
          
          <input type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>">
          <input type="hidden" name="actionType" value="Edit"> 
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
