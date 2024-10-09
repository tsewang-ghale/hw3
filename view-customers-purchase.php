<h1>Customers Purchases</h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Sale ID</th>
        <th>Customer First Name</th>
        th>Customer Last Name</th>
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

while ($sale = $sales->fetch_assoc()) {
?>
      <tr>
        <td><?php echo($sale['sale_id']); ?></td>
        <td><?php echo($sale['cust_firstname']); ?></td>
        <td><?php echo($sale['cust_lastname']); ?></td>
        <td><?php echo($sale['product_name']); ?></td>
        <td><?php echo($sale['sale_date']); ?></td> 
        <td><?php echo($sale['tax']); ?></td> 
        <td><?php echo($sale['shipping']); ?></td> 
        <td><?php echo($sale['quantity']); ?></td>
        <td><?php echo($sale['saleprice']); ?></td>
      </tr>
<?php
    }
?>
    </tbody>
  </table>
</div>

