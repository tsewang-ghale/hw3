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
        
        // Begin transaction
        $conn->begin_transaction();

        // Step 1: Update the Sale table
        $stmt = $conn->prepare("UPDATE `Sale` SET `sale_date` = ?, `tax` = ?, `shipping` = ? WHERE `Sale_id` = ?");
        
        if (!$stmt) {
            throw new Exception("Failed to prepare statement for Sale update: " . $conn->error);
        }

        $stmt->bind_param("siii", $saledate, $tax, $shipping, $sale_id); 
        $stmt->execute();
        $stmt->close();

        // Step 2: Update SaleItems' saleprice based on new tax and shipping values
        // The formula assumes that the saleprice depends on tax and shipping.
        $stmt = $conn->prepare("SELECT saleprice FROM SaleItem WHERE sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->bind_result($current_saleprice);

        // Loop through all sale items and update the saleprice
        while ($stmt->fetch()) {
            // Assuming the tax and shipping affect the saleprice directly
            $new_saleprice = $current_saleprice + $tax + $shipping;

            // Update the saleprice in SaleItem
            $updateStmt = $conn->prepare("UPDATE SaleItem SET saleprice = ? WHERE sale_id = ?");
            $updateStmt->bind_param("di", $new_saleprice, $sale_id);
            $updateStmt->execute();
            $updateStmt->close();
        }

        // Commit the transaction
        $conn->commit();

        // Close the connection
        $conn->close();
        
        return true; // Return true if successful
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        if ($conn) {
            $conn->rollback();
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
