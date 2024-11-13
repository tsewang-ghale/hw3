<?php
function selectCustomers() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT cust_firstname, cust_lastname, count(s.Sale_id) as numberofitemsbought FROM `Customer` c join `Sale` s on c.cust_id= s.cust_id group by cust_firstname, cust_lastname");
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
