<?php
function selectCustomersPurchase() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT si.sale_id, s.cust_id, s.sale_date, s.tax, s.shipping, si.quantity, si.saleprice FROM Sale s JOIN SaleItem si ON s.sale_id = si.sale_id WHERE si.sale_id = ?");
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
