<?php
// This file handles database interaction

function selectSaleItems() {
    try{
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT product_id, sale_id, quantity, saleprice COUNT(Saleitem_id) AS count_saleitem FROM saleitems GROUP BY Saleitem_id");
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

