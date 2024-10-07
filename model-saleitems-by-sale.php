<?php
function selectSaleitemsBySale($cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT s.sale_id, cust_id, sale_date FROM `sale` s join saleitem si on s.sale_id= si.sale_id where s.sale_id=?");
        $stmt->bind_param("i", $sid);
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
