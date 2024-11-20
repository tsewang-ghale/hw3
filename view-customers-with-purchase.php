<div class = "row"> 
  <div class = "col">
 <h1> Customer with purchase </h1>
  </div>
  <div class = "col-auto">
<?php
include "view-customers-with-purchase-newform.php"; 
?>  
  </div>
  </div>

<div class="card-group">


<?php
$customers = selectCustomers();
while ($customer = $customers->fetch_assoc()) {
?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $customer['cust_firstname'] . " " . $customer['cust_lastname']; ?></h5>
      <p class="card-text">
        <ul class="list-group">
          <?php
          // Fetch sales for this customer
          $sales = selectCustomersWithPurchase($customer['cust_id']);
          if ($sales->num_rows > 0) {
            while ($sale = $sales->fetch_assoc()) {
          ?>
              <li class="list-group-item">
                <?php echo $sale['sale_id']; ?> - 
                <?php echo $sale['product_name']; ?> - 
                <?php echo $sale['sale_date']; ?> - 
                <?php echo number_format($sale['saleprice'], 2); ?> -
                
                
                <?php
               $saleitem=selectSaleItemsBySaleId($sale['sale_id']);
                while ($saleitems = $saleitem->fetch_assoc()) {
                  ?>
                    <?php echo $saleitems['quantity']; ?> 
                    <?phpinclude "view-customers-with-purchase-editform.php"; ?>
                 <?php
                }
                ?>
                
                <form method= "post" action= "">
                <input type= "hidden" name = "sale_id" id ="sale_id" value= "<?php echo $sale['sale_id']; ?>">
                <input type= "hidden" name= "actionType" value = "Delete">
                <button type="submit" class="btn btn-primary" onclick= "return confirm ('Are you sure?');">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                  </svg>
                </button>
              </form>
              </li>
              
          <?php
            }
          } else {
            echo '<li class="list-group-item">No purchases</li>';
          }
          ?>
        </ul>
      </p>
      <p class="card-text">
        <small class="text-body-secondary">
          Customer Id: <?php echo $customer['cust_id']; ?> <br>
          Phone: <?php echo $customer['cust_phone']; ?> 
          Email: <?php echo $customer['cust_email']; ?>
          
        </small>
      </p>
      
      
      

    
    </div>
  </div>
<?php
}
?>
</div>
