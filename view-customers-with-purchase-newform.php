<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Customers with Purchase</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h1 class="text-center mb-4">Customers with Purchases</h1>

  <!-- Button to trigger modal -->
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
    </svg>
    Add New Customer
  </button>

  <!-- Modal for adding new customer -->
  <div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="newCustomerModalLabel">New Customer</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="mb-3">
              <label for="cust_firstname" class="form-label">First Name</label>
              <input type="text" class="form-control" id="cust_firstname" name="cust_firstname" required>
            </div>
            <div class="mb-3">
              <label for="cust_lastname" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="cust_lastname" name="cust_lastname" required>
            </div>
            <div class="mb-3">
              <label for="cust_address" class="form-label">Address</label>
              <input type="text" class="form-control" id="cust_address" name="cust_address" required>
            </div>
            <div class="mb-3">
              <label for="cust_phone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="cust_phone" name="cust_phone" required>
            </div>
            <div class="mb-3">
              <label for="cust_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="cust_email" name="cust_email" required>
            </div>
            <input type="hidden" name="actionType" value="Add">
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Table of customers -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      // Example customer data. Replace with dynamic content from your database.
      $customers = [
        ['cust_id' => 1, 'cust_firstname' => 'John', 'cust_lastname' => 'Doe', 'cust_address' => '123 Main St', 'cust_phone' => '123-456-7890', 'cust_email' => 'john@example.com'],
        ['cust_id' => 2, 'cust_firstname' => 'Jane', 'cust_lastname' => 'Smith', 'cust_address' => '456 Elm St', 'cust_phone' => '987-654-3210', 'cust_email' => 'jane@example.com'],
      ];
      foreach ($customers as $customer) { ?>
        <tr>
          <td><?php echo $customer['cust_id']; ?></td>
          <td><?php echo $customer['cust_firstname']; ?></td>
          <td><?php echo $customer['cust_lastname']; ?></td>
          <td><?php echo $customer['cust_address']; ?></td>
          <td><?php echo $customer['cust_phone']; ?></td>
          <td><?php echo $customer['cust_email']; ?></td>
          <td>
            <!-- Actions can be added here -->
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
