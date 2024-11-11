<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newSaleItemItemModal">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>
</button>

<!-- Modal -->
<div class="modal fade" id="newSaleItemModal" tabindex="-1" aria-labelledby="newSaleItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newSaleItemModalLabel"> New SaleItem</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method= "post" action = "">
          <div class="mb-3">
            <label for="product_id" class="form-label">Product ID</label>
            <input type="Integer" class="form-control" id="product_id" name = "product_id">
          </div>
          <div class="mb-3">
            <label for="sale_id" class="form-label"> Sale ID </label>
            <input type="integer" class="form-control" id="sale_id" name = "sale_id">
          </div>
           <div class="mb-3">
            <label for="quantity" class="form-label"> Quantity </label>
            <input type="Integer" class="form-control" id="quantity" name = "quantity">
          </div>
           <div class="mb-3">
            <label for="saleprice" class="form-label">Sale Price</label>
            <input type="integer" class="form-control" id="saleprice" name = "saleprice">
          </div>
          <input type = "hidden" name = "actionType" value = "Add"> 
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
