<h1>Customers Purchases</h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Sale ID</th>
        <th>Customer First Name</th>
        <th>Customer Last Name</th>
        <th>Product Name</th>
        <th>Sale Date</th> 
        <th>Tax</th>
        <th>Shipping</th>
        <th>Quantity</th>
        <th>Sale Price</th>
      </tr> 
    </thead>
    <tbody> 
<?php

while ($customer = $customers->fetch_assoc()) {
?>
      <tr>
        <td><?php echo($customer['cust_id']); ?></td>
        <td><?php echo($customer['cust_firstname']); ?></td>
        <td><?php echo($customer['cust_lastname']); ?></td>
        <td><?php echo($customer['product_name']); ?></td>
        <td><?php echo($customer['sale_date']); ?></td> 
        <td><?php echo($customer['tax']); ?></td> 
        <td><?php echo($customer['shipping']); ?></td> 
        <td><?php echo($customer['quantity']); ?></td>
        <td><?php echo($customer['saleprice']); ?></td>
      </tr>
<?php
    }
?>
    </tbody>
  </table>
</div>

