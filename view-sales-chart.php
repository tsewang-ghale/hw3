<h1>Sales Per Customer</h1>
<div>
  <canvas id="salesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('salesChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php
        // PHP code to generate customer names as labels
        echo "'" . implode("', '", $customerNames) . "'"; // Join customer names with commas
        ?>
      ],
      datasets: [{
        label: 'Number of Sales',
        data: [
          <?php
          // PHP code to generate sales data for the chart
          echo implode(", ", $saleData); // Convert sale data to a comma-separated string
          ?>
        ],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
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
