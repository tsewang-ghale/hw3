<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSaleItemModal<?php echo $saleitem['saleitem_id'];?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
      </svg>
</button>

<!-- Modal -->
<div class="modal fade" id="editSaleItemModal<?php echo $saleitem['saleitem_id']; ?>" tabindex="-1" aria-labelledby="editSaleItemModalLabel<?php echo $saleitem['saleitem_id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editSaleItemModalLabel<?php echo $saleitem['saleitem_id']; ?>"> Edit SaleItem</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method= "post" action = "">
          <div class="mb-3">
            <label for="product_ID <?php echo $saleitem['saleitem_id'];?>" class="form-label">Product ID</label>
            <input type="Integer" class="form-control" id="product_id <?php echo $saleitem['saleitem_id']; ?>" name = "product_id" value = "<?php echo $saleitem['product_id']; ?>">
          </div>
          <div class="mb-3">
            <label for="sale_id<?php echo $saleitem['saleitem_id']; ?>" class="form-label"> Sale ID </label>
            <input type="integer" class="form-control" id="sale_id <?php echo $saleitem['saleitem_id']; ?>" name = "sale_id" value= "<?php echo $saleitem['sale_id']; ?>">
          </div>
           <div class="mb-3">
            <label for="quantity <?php echo $saleitem['saleitem_id']; ?>" class="form-label">Quantity</label>
            <input type="Integer" class="form-control" id="quantity <?php echo $saleitem['saleitem_id']; ?>" name = "quantity" value = "<?php echo $saleitem['quantity']; ?>">
          </div>
           <div class="mb-3">
            <label for="saleprice <?php echo $saleitem['saleitem_id']; ?>" class="form-label">Sale Price</label>
            <input type="Integer" class="form-control" id="saleprice <?php echo $saleitem['saleitem_id']; ?>" name = "saleprice" value = "<?php echo $saleitem['saleprice']; ?>">
          </div>
            <input type="hidden" name = "sid" value = "<?php echo $saleitem['saleitem_id']; ?>">
          <input type = "hidden" name = "actionType" value = "Edit"> 
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
