<h1>Customers Purchases</h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Sale ID</th>
        <th>Customer Name</th>
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
// Check if there are any sales to display
if ($sales && $sales->num_rows > 0) {
    while ($sale = $sales->fetch_assoc()) {
?>
      <tr>
        <td><?php echo($sale['sale_id']); ?></td>
        <td><?php echo($sale['cust_name']); ?></td>
        <td><?php echo($sale['product_name']); ?></td>
        <td><?php echo($sale['sale_date']); ?></td> 
        <td><?php echo($sale['tax']); ?></td> 
        <td><?php echo($sale['shipping']); ?></td> 
        <td><?php echo($sale['quantity']); ?></td>
        <td><?php echo($sale['saleprice']); ?></td>
      </tr>
<?php
    }
} else {
    echo "<tr><td colspan='8'>No purchases found for this customer.</td></tr>";
}
?>
    </tbody>
  </table>
</div>

