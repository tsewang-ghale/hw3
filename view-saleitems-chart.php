<h1> Sale Items Chart </h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      datasets: [{
        label: 'Sale Items Count',  // Label for the dataset
        data: [ 
<?php
// Loop through the saleitems data and populate the count values
while ($saleitem = $saleitems->fetch_assoc()) {
    echo $saleitem['count_saleitem'] . ", ";  // Sales count for each item
}
?>
        ],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }],
      labels: [
<?php
// Rewind the result set if needed (optional) or ensure you fetch the data again
$saleitems = selectSaleItems();  // Re-fetch data for labels

// Loop through saleitems to fetch item names as labels
while ($saleitem = $saleitems->fetch_assoc()) {
    echo "'" . $saleitem['item_name'] . "', ";  // Replace 'item_name' with the correct field
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
