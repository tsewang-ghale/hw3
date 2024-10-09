<h1> Customers Purchases </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th> ID </th>
        <th> Cust_ID  </th>
        <th> Sale Date </th> 
        <th> Tax </th>
        <th> Shipping </th>
        <th> Quantity </th>
        <th> Sale Price </th>
      </tr> 
    </thead>
    <tbody> 
<?php
// Check if $sales is a valid result set and has data
if ($sales && $sales->num_rows > 0) {
    // Loop through each sale record
    while ($sale = $sales->fetch_assoc()) {
?>
      <tr>
        <td><?php echo htmlspecialchars($sale['sale_id']); ?> </td>
        <td><?php echo htmlspecialchars($sale['cust_id']); ?></td>
        <td><?php echo htmlspecialchars($sale['sale_date']); ?></td> 
        <td><?php echo htmlspecialchars($sale['tax']); ?></td> 
        <td><?php echo htmlspecialchars($sale['shipping']); ?></td> 
        <td><?php echo htmlspecialchars($sale['quantity']); ?></td>
        <td><?php echo htmlspecialchars($sale['saleprice']); ?></td>
      </tr>
<?php
    }
} else {
    // If no sales are found
    echo "<tr><td colspan='7'>No purchases found for this customer.</td></tr>";
}
?>
    </tbody>
  </table>
</div>
