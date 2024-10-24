<?php
function selectCustomers() {
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
function selectCustomersPurchase($custId) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT 
                s.sale_id, 
                c.cust_id, 
                c.cust_firstname,
                c.cust_lastname,
                p.product_name, 
                s.sale_date, 
                s.tax, 
                s.shipping, 
                si.quantity, 
                si.saleprice 
            FROM Sale s
            JOIN Customer c ON s.cust_id = c.cust_id
            JOIN SaleItem si ON s.sale_id = si.sale_id
            JOIN Product p ON si.product_id = p.product_id
            WHERE c.cust_id = ?");
        $stmt->bind_param("i", $custId);
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function insertCustomersPurchase($custId, $cfirstname, $clastname, $pname, $saledate, $tax, $shipping, $quantity, $saleprice ) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("insert into 'Sale' ('cust_id', 'cust_firstname', 'cust_lastname', 'product_name', 'sale_date', 'tax', 'shipping', 'quantity', 'saleprice' )");
        $stmt->bind_param("i", $custId, $cfirstname, $clastname,$clastname, $pname, $saledate, $tax, $shipping, $quantity, $saleprice );
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function UpdateSale($custId,$cfirstname, $clastname, $pname, $saledate, $tax, $shipping, $quantity, $saleprice, $sid) {
    try {
        $conn = get_db_connection();
        // Prepare the SQL query
        $stmt = $conn->prepare("UPDATE `Sale` SET $custId = ? ,$cfirstname = ?, $clastname =? , $pname =?, $saledate=?, $tax=?, $shipping=?, $quantity=?, $saleprice=? WHERE `Sale_id` = ?");
        // Bind all four parameters: sale_date (string), tax (integer), shipping (integer), and Sale_id (integer)
        $stmt->bind_param("issssiiiii", $custId,$cfirstname, $clastname, $pname, $saledate, $tax, $shipping, $quantity, $saleprice, $sid); 
        // Execute the statement
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function deleteSale($sid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("delete from`Sale` where Sale_id=?");
        $stmt->bind_param("i", $sid);
        $success= $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
