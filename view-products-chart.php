<h1>Product Sales Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'polarArea',  // Change to Polar Area chart
    data: {
      labels: [
        <?php
        // Fetch the product names for labels on the chart
        $products = selectProducts(); 
        while ($product = $products->fetch_assoc()) {
          echo "'" . $product['product_name'] . "', ";  // Product names
        }
        ?>
      ],
      datasets: [{
        label: 'Sales Count',  // Dataset label
        data: [
          <?php
          // Re-fetch the product data to get the sales count
          $products = selectProducts(); 
          while ($product = $products->fetch_assoc()) {
            echo $product['product_count'] . ", ";  // Sales count for each product
          }
          ?>
        ],
        backgroundColor: [
          'rgba(75, 192, 192, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        r: {
          beginAtZero: true  // Start radius scale at zero
        }
      }
    }
  });
</script>
