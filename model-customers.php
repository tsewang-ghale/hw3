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
function InsertCustomer($cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `Customer` (`cust_firstname`, `cust_lastname`, `cust_address`, `cust_phone`, `cust_email`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email);
        $success= $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function UpdateCustomer($cust_id, $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `Customer` SET `cust_firstname` = ?, `cust_lastname` = ?, `cust_address` = ?, `cust_phone`=?, `cust_email`= ? WHERE `cust_id` = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("sssssi", $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email,$cust_id; 
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e; 
    }
}
function deleteCustomer($cust_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `Customer` WHERE cust_id = ?");
        $stmt->bind_param("i", $cust_id); // Use $sale_id instead of $sid
        $success = $stmt->execute();
        $stmt->close(); // Close the statement after execution
        $conn->close(); // Close the connection
        return $success;
    } catch (Exception $e) {
        $conn->close(); // Ensure the connection is closed in case of an error
        throw $e; // Rethrow the exception for further handling
    }
}

?>
