<?php
require_once("util-db.php");

function selectProducts() {
    try {
        $conn = get_db_connection();  // Get the database connection
        
        // SQL query to fetch product sales count
        $stmt = $conn->prepare("
            SELECT product_name, COUNT(*) AS product_count 
            FROM product p 
            GROUP BY product_name
        ");
        
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
