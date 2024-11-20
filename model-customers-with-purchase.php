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
function selectCustomersWithPurchase($custId) {
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
function selectSaleItemsBySaleId($saleId) {
    try {
        $conn = get_db_connection();  // Assume you have a function to get DB connection
        $stmt = $conn->prepare("
            SELECT 
                si.saleitem_id, 
                si.sale_id, 
                si.product_id, 
                p.product_name, 
                si.quantity, 
                si.saleprice
            FROM SaleItem si
            JOIN Product p ON si.product_id = p.product_id
            WHERE si.sale_id = ?");
        $stmt->bind_param("i", $saleId);  // Bind the sale_id as an integer
        $stmt->execute();  // Execute the query
        $result = $stmt->get_result();  // Get the result set
        
        // Fetch the single row
        $row = $result->fetch_assoc();  // This will return a single row as an associative array

        $conn->close();  // Close the connection
        
        // Return the single row (or null if no rows found)
        return $row ? $row : null;
    } catch (Exception $e) {
        $conn->close();  // Ensure the connection is closed on error
        throw $e;  // Re-throw the exception
    }
}


function InsertCustomersWithPurchase($product_id, $cust_id, $sale_date, $quantity, $tax, $shipping) {
    try {
        $quantity = (float)$quantity;
        $tax = (float)$tax;
        $shipping = (float)$shipping;
        // Establish DB connection
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT listprice FROM Product WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
            
        if ($row = $result->fetch_assoc()) {
            $product_price = (float)$row['listprice'];
        } else {
            throw new Exception("Product not found with ID: $product_id");
        }
            
        $stmt->close();
        // Start transaction to ensure data consistency
        $conn->begin_transaction();
        
        // Insert into Sale table
        $stmt = $conn->prepare("INSERT INTO `Sale` (`cust_id`, `sale_date`, `tax`, `shipping`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isdd", $cust_id, $sale_date, $tax, $shipping);
        $stmt->execute();
        
        // Get the last inserted sale_id
        $sale_id = $conn->insert_id;
        
        // Insert into Saleitem table
        $saleprice = $quantity * ($product_price) + $tax + $shipping;
        $stmt = $conn->prepare("INSERT INTO `SaleItem` (`product_id`, `sale_id`, `quantity`, `saleprice`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $product_id, $sale_id, $quantity, $saleprice);
        $stmt->execute();
        
        // Commit transaction
        $conn->commit();
        
        // Close connection
        $conn->close();
        
        return true; // Success
    } catch (Exception $e) {
        // Rollback in case of an error
        $conn->rollback();
        $conn->close();
        throw $e;
    }
}

function UpdateCustomersWithPurchase($cust_id, $cust_firstname, $cust_lastname, $cust_phone, $cust_email) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `Customer` SET `cust_firstname` = ?, `cust_lastname` = ?,'cust_phone'=?, 'cust_email'= ? WHERE `cust_id` = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("issss", $cust_id, $cust_firstname, $cust_lastname, $cust_phone, $cust_email); 
        $success = $stmt->execute();
        $stmt->close();

        
        $stmt = $conn->prepare("UPDATE `Sale` SET `sale_date` = ? WHERE `cust_id` = ?");
        
        // Check if the statement was prepared correctly
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        
        // Bind the parameters: sale_date (string), and cust_id (integer)
        $stmt->bind_param("si", $saledate, $cust_id);
        
        // Execute the statement
        $success = $stmt->execute();
        
        // Close the statement after execution
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
function deleteCustomersWithPurchase($sale_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `SaleItem` WHERE Sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $success = $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM `Sale` WHERE Sale_id = ?");
        $stmt->bind_param("i", $sale_id); // Use $sale_id instead of $sid
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
