<?php
function selectCustomersPurchase($id) {  // Make sure $id is passed as a parameter
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT  
                s.sale_id, 
                s.sale_date, 
                s.tax, 
                s.shipping,
                si.quantity, 
                si.saleprice
            FROM Sale s
            JOIN Saleitem si ON si.sale_id = s.sale_id
            WHERE s.sale_id = ?");  // Fix the WHERE clause to refer to the correct table alias "s"
        $stmt->bind_param("i", $id);  // Ensure we bind the $id parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
