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
    <td> <a href = "sales-made-by-customer.php?id=<?php echo $customer['cust_id']; ?>" > Sales</a></td>
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
