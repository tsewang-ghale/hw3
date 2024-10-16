<?php
function selectCustomersPurchase($sale_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT  
                s.sale_id, 
                s.sale_date, 
                s.tax, 
                s.shipping
            FROM Sale s
            JOIN Customer c ON s.cust_id = c.cust_id
            WHERE c.cust_id = ?");
        $stmt->bind_param("i", $Sale_id);
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
