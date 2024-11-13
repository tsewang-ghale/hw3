<h1> Sale Items Total Price Chart </h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',  // Change to line chart
    data: {
      labels: [
        <?php
        // Fetch sale items data and generate labels for each saleitem_id
        $saleitems = selectSaleItems();
        while ($saleitem = $saleitems->fetch_assoc()) {
            echo "'" . $saleitem['saleitem_id'] . "', ";  // Sale item IDs as labels
        }
        ?>
      ],
      datasets: [{
        label: 'Total Price for Each Sale Item',
        data: [
          <?php
          // Re-fetch sale items data to generate the total_price data points
          $saleitems = selectSaleItems();
          while ($saleitem = $saleitems->fetch_assoc()) {
              echo $saleitem['total_price'] . ", ";  // Total price for each sale item
          }
          ?>
        ],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',  // Line chart background color (slightly transparent)
        borderColor: 'rgba(54, 162, 235, 1)',  // Line color
        borderWidth: 2,  // Line width
        tension: 0.2  // Smooth the line (optional)
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Total Price (quantity * saleprice)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Sale Item ID'
          }
        }
      }
    }
  });
</script>
