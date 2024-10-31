<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>
</button>

<!-- Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newCustomerModalLabel"> New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method= "post" action = "">
          <div class="mb-3">
            <label for="cust_firstname" class="form-label">First Name </label>
            <input type="text" class="form-control" id="cust_firstname" name = "cust_firstname">
          </div>
           <div class="mb-3">
            <label for="cust_lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="cust_lastname" name = "cust_lastname">
          </div>
           <div class="mb-3">
            <label for="cust_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="cust_address" name = "cust_address">
          </div>
           <div class="mb-3">
            <label for="cust_phone" class="form-label">Phone </label>
            <input type="text" class="form-control" id="cust_phone" name = "cust_phone">
          </div>
           <div class="mb-3">
            <label for="cust_email" class="form-label">Email</label>
            <input type="text" class="form-control" id="cust_email" name = "cust_email">
          </div>
          <input type = "hidden" name = "actionType" value = "Add"> 
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>