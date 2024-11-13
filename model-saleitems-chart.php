<?php
function selectSaleItems() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
        SELECT si.saleitem_id,si.product_id,(si.quantity * si.saleprice) AS total_price FROM `SaleItem` si group by si.saleitem_id,si.product_id ");
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
