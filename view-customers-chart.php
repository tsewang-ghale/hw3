<h1> Customers Chart</h1>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data:{
    datasets: [{
        data: [
<?php
while ($customer= $customers -> fetch_assoc()){
echo $customer['numberofitemsbought'] . ", "; 
}
?>
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
<?php
$customers = selectCustomers(); 
while ($customer= $customers -> fetch_assoc()){
echo $customer['cust_lastname'] . ", "; 
}
?>
    ]
},

  });
</script>
