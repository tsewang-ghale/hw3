<?php
function selectSales() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT cust_id, cust_firstname, cust_lastname, cust_address, cust_phone, cust_email FROM `Customer`");
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
