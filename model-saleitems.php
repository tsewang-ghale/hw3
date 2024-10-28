<?php
function selectSaleItemItems() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT SaleItemitem_id, product_id, SaleItem_id, quantity, SaleItemprice FROM `SaleItemItem`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function InsertSaleItemItem($cid, $SaleItemdate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `SaleItem` (`cust_id`, `SaleItem_date`, `tax`, `shipping`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $cid,$SaleItemdate, $tax, $shipping);
        $success= $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}


function UpdateSaleItemItem($SaleItem_id, $SaleItemdate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        // Prepare the SQL query
        $stmt = $conn->prepare("UPDATE `SaleItem` SET `SaleItem_date` = ?, `tax` = ?, `shipping` = ? WHERE `SaleItem_id` = ?");
        
        // Check if the statement was prepared correctly
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind all four parameters: SaleItem_date (string), tax (integer), shipping (integer), and SaleItem_id (integer)
        $stmt->bind_param("siii", $SaleItemdate, $tax, $shipping, $SaleItem_id); 
        
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


function deleteSaleItem($SaleItem_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `SaleItem` WHERE SaleItem_id = ?");
        $stmt->bind_param("i", $SaleItem_id); // Use $SaleItem_id instead of $sid
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
