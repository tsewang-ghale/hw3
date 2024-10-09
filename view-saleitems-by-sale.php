<h1>Saleitems By Sale</h1>
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

while ($saleitem = $saleitems->fetch_assoc()) {
?>
      <tr>
        <td><?php echo($saleitem['sale_id']); ?></td>
        <td><?php echo($saleitem['cust_firstname']); ?></td>
        <td><?php echo($saleitem['cust_lastname']); ?></td>
        <td><?php echo($saleitem['product_name']); ?></td>
        <td><?php echo($saleitem['sale_date']); ?></td> 
        <td><?php echo($saleitem['tax']); ?></td> 
        <td><?php echo($saleitem['shipping']); ?></td> 
        <td><?php echo($saleitem['quantity']); ?></td>
        <td><?php echo($saleitem['saleprice']); ?></td>
      </tr>
<?php
    }
?>
    </tbody>
  </table>
</div>
