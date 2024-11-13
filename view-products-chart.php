<h1>Product Sales Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar', // Bar chart for product sales count
    data: {
      datasets: [{
        label: 'Sales Count',  // Dataset label
        data: [
          <?php
          // Fetch the product data and display it
          $products = selectProducts(); 
          while ($product = $products->fetch_assoc()) {
            echo $product['product_count'] . ", ";  // Sales count for each product
          }
          ?>
        ],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }],
      labels: [
        <?php
        // Fetch the product names for labels on the chart
        $products = selectProducts(); 
        while ($product = $products->fetch_assoc()) {
          echo "'" . $product['product_name'] . "', ";  // Product names
        }
        ?>
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
