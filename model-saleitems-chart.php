<?php
// model-saleitems-chart.php

// Assuming get_db_connection() is defined elsewhere and it returns a valid DB connection
function selectSaleItems() {
    try {
        $conn = get_db_connection();  // Establish DB connection
        $stmt = $conn->prepare("SELECT product_id, sale_id, quantity, saleprice, COUNT(Saleitem_id) AS count_saleitem 
                                FROM saleitems 
                                GROUP BY product_id, sale_id, quantity, saleprice");
        $stmt->execute();
        $result = $stmt->get_result();  // Get the result
        $conn->close();  // Close the DB connection
        return $result;  // Return the result
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();  // Ensure the connection is closed in case of error
        }
        throw $e;  // Rethrow the exception
    }
}
?>
