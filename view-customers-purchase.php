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
while ($sale= $sales -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $sale['sale_id']; ?> </td>
    <td><?php echo $sale['cust_id']; ?></td>
    <td><?php echo $sale['sale_date']; ?></td> 
    <td><?php echo $sale['tax']; ?></td> 
    <td><?php echo $sale['shipping']; ?></td> 
    <td><?php echo $sale['quantity']; ?></td>
    <td><?php echo $sale['saleprice']; ?></td>
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>