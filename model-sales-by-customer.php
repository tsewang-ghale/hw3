<?php
function selectSalesByCustomer($iid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT s.sale_id, cust_id, sale_date, tax, shipping FROM `sale` s join saleitem si on s.sale_id= si.sale_id where s.customer_id = ?");
        $stmt->bind_param("i", $iid);
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
