<h1> Sales </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Cust_ID  </th>
      <th> Sale Date </th> 
      <th> Tax </th>
      <th> Shipping </th>
      <th> </th>
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
    <td> <a href= "customers-with-purchase.php?id=<?php echo $sale['sale_id']; ?> "> Customers </a></td>
  
    <td>
      <form method= "post" action= "saleitems-by-sale.php">
        <input type= "hidden" name = "cid" value= "<?php echo $sale['sale_id']; ?>">
        <button type="submit" class="btn btn-primary">Sale Items</button>
      </form>
    </td>
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
