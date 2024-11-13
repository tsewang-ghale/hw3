<?php
// Include database connection file
require_once("util-db.php");

// Function to fetch the sales data for the chart
function getSalesDataPerCustomer() {
    // Prepare the SQL query to fetch sales data grouped by customer
    $sql = "SELECT cust_id, COUNT(sale_id) AS sale_count 
            FROM sales 
            GROUP BY cust_id"; // Group by customer to count sales
    
    // Execute the query
    $result = executeQuery($sql);

    // Initialize arrays to hold the results
    $salesData = [];
    $customerNames = [];
    
    // Fetch the results and populate the arrays
    while ($row = $result->fetch_assoc()) {
        $customerNames[] = $row['cust_id']; // Store customer ID
        $salesData[] = $row['sale_count'];  // Store the number of sales
    }
    
    // Return the data as an associative array
    return [
        'customerNames' => $customerNames,
        'salesData' => $salesData
    ];
}

// Alternatively, if you want to return sales over time, you could create a similar function
function getSalesDataOverTime() {
    $sql = "SELECT sale_date, COUNT(sale_id) AS sale_count 
            FROM sales 
            GROUP BY sale_date"; // Group by date to count sales per day
    
    // Execute the query
    $result = executeQuery($sql);

    // Initialize arrays to hold the results
    $salesData = [];
    $saleDates = [];
    
    // Fetch the results and populate the arrays
    while ($row = $result->fetch_assoc()) {
        $saleDates[] = $row['sale_date']; // Store sale date
        $salesData[] = $row['sale_count']; // Store the number of sales
    }
    
    // Return the data as an associative array
    return [
        'saleDates' => $saleDates,
        'salesData' => $salesData
    ];
}
?>
