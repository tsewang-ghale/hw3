<?php
function selectSaleItems() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT saleitem_id, product_id, sale_id, quantity, saleprice FROM `saleitem`");
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
