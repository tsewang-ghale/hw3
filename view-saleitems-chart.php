<div>
  <canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php
          while ($item = $saleItems->fetch_assoc()) {
              echo "'" . $item['item_id'] . "', ";
          }
      ?>],
      datasets: [{
        label: 'Total Quantity Sold',
        data: [<?php
            mysqli_data_seek($saleItems, 0); 
            while ($item = $saleItems->fetch_assoc()) {
                echo $item['total_quantity'] . ", ";
            }
        ?>],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      },
      {
        label: 'Total Sales Price',
        data: [<?php
            mysqli_data_seek($saleItems, 0); 
            while ($item = $saleItems->fetch_assoc()) {
                echo $item['total_price'] . ", ";
            }
        ?>],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
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
