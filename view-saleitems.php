<h1> Sale Items </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Product_ID </th> <!-- Corrected typo here -->
      <th> Sale_ID </th> 
      <th> Qantity</th> 
      <th> Sale Price </th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($saleitem = $saleitems -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $saleitem['saleitem_id']; ?> </td>
    <td><?php echo $saleitem['product_id']; ?></td>
    <td><?php echo $saleitem['sale_id']; ?></td> 
    <td><?php echo $saleitem['quantity']; ?></td> 
    <td><?php echo $saleitem['saleprice']; ?></td> 
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
