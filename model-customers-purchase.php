<?php
function selectCustomersPurchase() {
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
            WHERE c.sale_id = ?");
        $stmt->bind_param("i", $id);
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
