
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newform1CustomerPurchaseModal">
       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
           <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
         </svg>
</button>

      <!-- Modal -->
      <div class="modal fade" id="newform1CustomerPurchaseModal" tabindex="-1" aria-labelledby="newform1CustomerPurchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="newform1CustomerPurchaseModalLabel"> New Customers with Purchase</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                     <div class="mb-3">
                           <label for="cust_id" class="form-label">Cust ID</label>
                           <input type="integer" class="form-control" id="cust_id">
                     </div>
                     <div class="mb-3">
                           <label for="cust_firstname" class="form-label"> Customer First Name</label>
                           <input type="text" class="form-control" id="'cust_firstname">
                     </div>
                     <div class="mb-3">
                           <label for="cust_lastname" class="form-label"> Customer Last Name</label>
                           <input type="text" class="form-control" id="'cust_lastname">
                      </div>
                      <div class="mb-3">
                           <label for="product_name" class="form-label"> Product Name</label>
                           <input type="text" class="form-control" id="'product_name">
                      </div>
                      <div class="mb-3">
                           <label for="sale_date" class="form-label"> Sale Date </label>
                           <input type="date" class="form-control" id="'sale_date">
                       </div>
                       <div class="mb-3">
                           <label for="tax" class="form-label"> Tax </label>
                           <input type="integer" class="form-control" id="'tax">
                       </div>
                      <div class="mb-3">
                           <label for="shipping" class="form-label"> Shipping </label>
                           <input type="integer" class="form-control" id="'shipping">
                     </div>
                     <div class="mb-3">
                           <label for="quantity" class="form-label"> Quantity </label>
                           <input type="integer" class="form-control" id="'quantity">
                     </div>
                     <div class="mb-3">
                           <label for="saleprice" class="form-label"> Sale Price </label>
                           <input type="integer" class="form-control" id="'saleprice">
                     </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>
