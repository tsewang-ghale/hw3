<div class = "row"> 
  <div class = "col">
 <h1> Sales </h1>
  </div>
  <div class = "col-auto">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
  </svg>
  </div>
</div>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Cust_ID  </th>
      <th> Sale Date </th> 
      <th> Tax </th>
      <th> Shipping </th>
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
