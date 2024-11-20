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
        $conn->begin_transaction(); // Start transaction

        // Step 1: Update Sale Table
        $stmt = $conn->prepare("UPDATE `Sale` SET `sale_date` = ?, `tax` = ?, `shipping` = ? WHERE `Sale_id` = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("siii", $saledate, $tax, $shipping, $sale_id);
        $stmt->execute(); // Execute update
        $stmt->close(); // Close after execution

        // Step 2: Retrieve product_id, quantity from SaleItem
        $stmt = $conn->prepare("SELECT product_id, quantity FROM SaleItem WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Assuming only one item in SaleItem for this Sale
            $row = $result->fetch_assoc();
            $product_id = $row['product_id']; // Get the product_id
            $quantity = $row['quantity']; // Get the quantity
        }
        $stmt->close(); // Close after execution

        // Step 3: Retrieve product listprice from Product table
        $stmt = $conn->prepare("SELECT listprice FROM Product WHERE product_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $product_id); // Use the product_id to fetch price
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Assuming we get a valid product
            $product_row = $result->fetch_assoc();
            $product_price = $product_row['listprice']; // Get the product listprice
        } else {
            throw new Exception("Product not found for product_id: " . $product_id);
        }
        $stmt->close(); // Close after execution

        // Step 4: Calculate the total price (product price * quantity) and add the tax and shipping
        $calculated_price = ($product_price * $quantity) + $tax + $shipping;

        // Step 5: Update SaleItem with the new sale price
        $stmt = $conn->prepare("UPDATE SaleItem SET saleprice = ? WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("di", $calculated_price, $sale_id); // Bind the calculated price and sale_id
        $stmt->execute(); // Execute update
        $stmt->close(); // Close after execution
        
        $conn->commit(); // Commit transaction if both updates succeed
        $conn->close();
        
        return true; // Return success
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction if any error occurs
        $conn->close();
        throw $e; // Re-throw the exception
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
