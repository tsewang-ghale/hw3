<?php
function selectSaleItems() {
    try {
        $conn = get_db_connection();  // Get the database connection
        
        // Prepare the query to select sale items data
        $stmt = $conn->prepare("SELECT sale_id, quantity, saleprice, COUNT(Saleitem_id) AS count_saleitem 
                                FROM saleitem si join sale s on si.saleid= s.saleid
                                GROUP BY sale_id, quantity, saleprice");
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
