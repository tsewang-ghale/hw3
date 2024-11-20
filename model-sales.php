<?php
function selectSales() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT sale_id, cust_id, sale_date, tax, shipping FROM `Sale`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function InsertSale($cid, $saledate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `Sale` (`cust_id`, `sale_date`, `tax`, `shipping`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $cid,$saledate, $tax, $shipping);
        $success= $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}


function UpdateSale($sale_id, $saledate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        // Prepare the SQL query
        $stmt = $conn->prepare("UPDATE `Sale` SET `sale_date` = ?, `tax` = ?, `shipping` = ? WHERE `Sale_id` = ?");
        
        // Check if the statement was prepared correctly
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind all four parameters: sale_date (string), tax (integer), shipping (integer), and Sale_id (integer)
        $stmt->bind_param("siii", $saledate, $tax, $shipping, $sale_id); 
        
        // Execute the statement
        $success = $stmt->execute();
        
        // Close the statement after execution
        $stmt->close();
        
        // Close the connection
        $conn->close();
        
        return $success;
    } catch (Exception $e) {
        // Ensure the connection is closed in case of an error
        if ($conn) {
            $conn->close();
        }
        throw $e; // Rethrow the exception for further handling
    }
}


function deleteSale($sale_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `Sale` WHERE Sale_id = ?");
        $stmt->bind_param("i", $sale_id); // Use $sale_id instead of $sid
        $success = $stmt->execute();
        $stmt->close(); // Close the statement after execution
        $stmt = $conn->prepare("DELETE FROM `SaleItem` WHERE Sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $success = $stmt->execute();
        $stmt->close();
        
        $conn->close(); // Close the connection
        return $success;
    } catch (Exception $e) {
        $conn->close(); // Ensure the connection is closed in case of an error
        throw $e; // Rethrow the exception for further handling
    }
}

?>
