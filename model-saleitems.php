<?php
function selectsaleItems() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT SaleItemitem_id, product_id,sale_id, quantity, saleprice SaleItemprice FROM `SaleItemItem`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function InsertSaleItems($product_id, $sale_id, $quantity, $saleprice) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `SaleItem` (`product_id`, `sale_id`, `quantity`, `saleprice`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $product_id, $sale_id, $quantity, $saleprice);
        $success= $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function UpdateSaleItems($SaleItemitem_id,$product_id, $sale_id, $quantity, $saleprice) {
    try {
        $conn = get_db_connection();
        // Prepare the SQL query
        $stmt = $conn->prepare("UPDATE `SaleItem` SET `product_id` = ?, `sale_id` = ?, `quantity` = ?, `saleprice` = ? WHERE `SaleItem_id` = ?");
        
        // Check if the statement was prepared correctly
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("iiiid", $product_id, $sale_id, $quantity, $saleprice,$SaleItemitem_id); 
        
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


function deleteSaleItems($SaleItem_id) {
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
