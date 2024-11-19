<?php
// Function to retrieve all customers
function selectCustomers() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT cust_id, cust_firstname, cust_lastname, cust_address, cust_phone, cust_email FROM `Customer`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

// Function to retrieve all purchases for a specific customer
function selectCustomersPurchase($cust_id) {
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
            WHERE c.cust_id = ?
        ");
        $stmt->bind_param("i", $cust_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

// Function to insert a new purchase record for a customer
function insertCustomersPurchase($cust_firstname, $cust_lastname) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `Customer` (`cust_firstname`, `cust_lastname`) 
            VALUES (?, ?, ?)"  );
        $stmt->bind_param("ss", $cust_firstname, $cust_lastname);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

// Function to update a purchase record for a specific sale ID
function updateCustomersPurchase($cust_id, $cust_firstname, $cust_lastname, $product_name, $saledate, $tax, $shipping, $quantity, $saleprice, $sid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `Sale` SET `cust_id` = ?, `cust_firstname` = ?, `cust_lastname` = ?, `product_name` = ?, `sale_date` = ?, `tax` = ?, `shipping`= ?, `quantity` = ?, `saleprice` = ? 
            WHERE sale_id = ?
        ");
        $stmt->bind_param("issssiiiii", $cust_id, $cust_firstname, $cust_lastname, $product_name, $saledate, $tax, $shipping, $quantity, $saleprice, $sid);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

// Function to delete a purch
function deleteCustomersPurchase($cust_id) {
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

