<?php
function selectSaleItems() {
    try {
        $conn = get_db_connection();  // Get the database connection
        
        // Prepare the query to select sale items data
       $stmt = $conn->prepare("
            SELECT 
                si.sale_id, 
                si.quantity, 
                si.saleprice, 
                COUNT(si.Saleitem_id) AS count_saleitem
            FROM `Saleitem` si 
            JOIN `Sale` s ON si.sale_id = s.sale_id
            GROUP BY si.sale_id, si.quantity, si.saleprice
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
