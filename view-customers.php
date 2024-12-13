<h1> Customers </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> First Name </th>
      <th> Last Name  </th> 
      <th> Address  </th> 
      <th> Phone  </th> 
      <th> Email  </th> 
      <th> </th>
      </tr> 
    </thead>
    <tbody> 
<?php
while ($customer= $customers -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $customer['cust_id']; ?> </td>
    <td><?php echo $customer['cust_firstname']; ?></td>
    <td><?php echo $customer['cust_lastname']; ?></td> 
    <td><?php echo $customer['cust_address']; ?></td> 
    <td><?php echo $customer['cust_phone']; ?></td> 
    <td><?php echo $customer['cust_email']; ?></td> 
    <td> <a href = "customers-purchase.php?id=<?php echo $customer['cust_id']; ?>" > Customers Purchases</a></td>
 
      <td>
      <form method= "post" action= "customers-purchase.php">
        <input type= "hidden" name = "cid" value= "<?php echo $customer['cust_id']; ?>">
        <button type="submit" class="btn btn-primary">Customers Purchases </button>
      </form>
    </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
