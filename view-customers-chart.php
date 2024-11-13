<h1> Customers Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [
          <?php
          // Initialize the $customers variable to fetch the data from the database
          $customers = selectCustomers(); 
          while ($customer = $customers->fetch_assoc()) {
            echo $customer['count_sale'] . ", "; 
          }
          ?>
        ], 
        // The labels that will appear in the chart's legend and tooltips
        backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f1c40f'], // You can customize the colors here
      }],
      labels: [
        <?php
        // Reset $customers and fetch the customers' names
        $customers = selectCustomers(); 
        while ($customer = $customers->fetch_assoc()) {
          echo "'" . $customer['cust_lastname'] . "', "; 
        }
        ?>
      ]
    },
  });
</script>
