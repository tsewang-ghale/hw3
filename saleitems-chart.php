<?php

require_once("model-saleitems-chart.php"); // Include the model to fetch data

$saleItems = selectSaleItems(); // Get sale items data from the database

$pageTitle = "Sale Items Chart";
include "view-header.php"; // Include header (view-header.php)

?>

<h1>Sale Items Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar', // Using bar chart for sale items
    data: {
      labels: [<?php
          // Fetch item names from the database and populate labels
          while ($item = $saleItems->fetch_assoc()) {
              echo "'" . $item['item_id'] . "', "; // Assuming you have item names
          }
      ?>],
      datasets: [{
        label: 'Total Quantity Sold',
        data: [<?php
            // Fetch total quantities for the items
            mysqli_data_seek($saleItems, 0); // Reset the result pointer
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
            // Fetch total sales prices for the items
            mysqli_data_seek($saleItems, 0); // Reset the result pointer
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

<?php
include "view-footer.php"; // Include footer (view-footer.php)
?>
