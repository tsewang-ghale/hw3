<h1>Sale Items Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',  // Choose the chart type (bar, doughnut, etc.)
    data: {
      datasets: [{
        label: 'Sale Items Count',  // Label for the dataset
        data: [
          <?php
          // Initialize the $saleitems variable to fetch the sale items data
          $saleitems = selectSaleItems(); 
          while ($saleitem = $saleitems->fetch_assoc()) {
            echo $saleitem['count_saleitem'] . ", ";  // Sale items count for each product
          }
          ?>
        ],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Customize the background color
        borderColor: 'rgba(75, 192, 192, 1)',  // Customize the border color
        borderWidth: 1  // Customize the border width
      }],
      labels: [
        <?php
        // Reset $saleitems and fetch the labels (product details like product_id, sale_id, etc.)
        $saleitems = selectSaleItems(); 
        while ($saleitem = $saleitems->fetch_assoc()) {
          echo "'". $saleitem['sale_id'] . "', "; 
        }
        ?>
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true  // Start the Y-axis at zero
        }
      }
    }
  });
</script>
