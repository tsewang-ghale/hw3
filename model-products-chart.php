<?php
function selectProducts() {
    try {
        $conn = get_db_connection();  // Get the database connection
        
        // Prepare the SQL query to fetch product sales count
        $stmt = $conn->prepare("SELECT p.product_name, COUNT(p.product_id) AS product_count FROM `Product` p GROUP BY p.product_name");
        $stmt->execute();  // Execute the query
        $result = $stmt->get_result();  // Get the result
        $conn->close();  // Close the connection
        return $result;  // Return the result
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();  // Ensure connection is closed in case of error
        }
        throw $e;  // Rethrow the exception
    }
}
?>
