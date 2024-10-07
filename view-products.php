<h1> Sales </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Product Name </th>
      <th> Product Description </th> 
      <th> List Price </th>
      <th> Color </th>
       <th> Category </th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($product= $products -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $product['product_id']; ?> </td>
    <td><?php echo $product['product_name']; ?></td>
    <td><?php echo$product['product_description']; ?></td> 
    <td><?php echo $product['listprice']; ?></td> 
    <td><?php echo $product['color']; ?></td> 
    <td><?php echo $product['category']; ?></td> 
  
    <td>
      <form method= "post" action= "saleitems-by-sale.php">
        <input type= "hidden" name = "sid" value= "<?php echo $sale['sale_id']; ?>">
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
