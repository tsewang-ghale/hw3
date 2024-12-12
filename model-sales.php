<?php
function selectSales() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT sale_id, cust_id, sale_date, tax, shipping FROM Sale");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

function InsertSale($cid, $saledate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO Sale (cust_id, sale_date, tax, shipping) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $cid, $saledate, $tax, $shipping);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        throw $e;
    }
}

function UpdateSale($sale_id, $cust_id, $saledate, $tax, $shipping) {
    try {
        // Establish database connection
        $conn = get_db_connection();
        if (!$conn) {
            throw new Exception("Database connection failed.");
        }

        // Start transaction
        $conn->begin_transaction();

        // Step 1: Verify that the Sale exists with the given sale_id
        $stmt = $conn->prepare("SELECT sale_id, cust_id, sale_date, tax, shipping FROM Sale WHERE Sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            throw new Exception("Sale ID $sale_id does not exist.");
        }

        // Fetch current data for comparison
        $stmt->bind_result($current_sale_id, $current_cust_id, $current_sale_date, $current_tax, $current_shipping);
        $stmt->fetch();
        $stmt->close();

        // Step 2: If values haven't changed, do nothing and return true
        if ($current_cust_id == $cust_id && $current_sale_date == $saledate && $current_tax == $tax && $current_shipping == $shipping) {
            return true; // No changes to be made
        }

        // Step 3: Update Sale Table with new values (including cust_id)
        $stmt = $conn->prepare("UPDATE Sale SET cust_id = ?, sale_date = ?, tax = ?, shipping = ? WHERE Sale_id = ?");
        $stmt->bind_param("isiii", $cust_id, $saledate, $tax, $shipping, $sale_id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $conn->rollback();
            throw new Exception("No rows were updated in Sale table for sale_id: $sale_id.");
        }
        $stmt->close();

        // Step 4: Retrieve product_id and quantity from SaleItem table
        $stmt = $conn->prepare("SELECT saleitem_id, product_id, quantity FROM SaleItem WHERE sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Loop over all SaleItem records for the sale_id
            while ($row = $result->fetch_assoc()) {
                $saleitem_id = $row['saleitem_id'];
                $product_id = $row['product_id'];
                $original_quantity = $row['quantity'];

                // Calculate the new sale price based on any changes in quantity
                // For simplicity, assuming you're modifying the quantity, you can modify as needed
                $new_quantity = $original_quantity;  // Adjust based on your logic
                $stmt_price = $conn->prepare("SELECT listprice FROM Product WHERE product_id = ?");
                $stmt_price->bind_param("i", $product_id);
                $stmt_price->execute();
                $result_price = $stmt_price->get_result();

                if ($result_price->num_rows > 0) {
                    $row_price = $result_price->fetch_assoc();
                    $listprice = $row_price['listprice'];

                    // Calculate the new sale price based on quantity and listprice
                    $new_saleprice = $listprice * $new_quantity;
                    
                    // Call the function to update SaleItem record
                    if (!UpdateSaleItems($saleitem_id, $product_id, $sale_id, $new_quantity, $new_saleprice)) {
                        $conn->rollback();
                        throw new Exception("Failed to update SaleItem with saleitem_id: $saleitem_id");
                    }
                } else {
                    $conn->rollback();
                    throw new Exception("Product not found for product_id: $product_id.");
                }
            }
        } else {
            $conn->rollback();
            throw new Exception("No SaleItem records found for sale_id: $sale_id.");
        }
        $stmt->close();

        // Step 5: Commit transaction if all steps succeed
        $conn->commit();
        $conn->close();

        return true; // Return success
    } catch (Exception $e) {
        if (isset($conn)) {
            $conn->rollback(); // Rollback in case of error
            $conn->close();
        }
        error_log($e->getMessage()); // Log error for debugging purposes
        throw $e; // Rethrow exception for handling by caller
    }
}




function deleteSale($sale_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM Sale WHERE sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $success = $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM SaleItem WHERE sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $success = $stmt->execute();
        $stmt->close();

        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) $conn->close();
        error_log($e->getMessage());
        throw $e;
    }
}
?>
