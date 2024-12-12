<?php
function selectSales() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT Sale_id, cust_id, sale_date, tax, shipping FROM Sale");
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

function UpdateSale($Sale_id, $cust_id, $saledate, $tax, $shipping) {
    try {
        // Establish database connection
        $conn = get_db_connection();
        if (!$conn) {
            throw new Exception("Database connection failed.");
        }

        // Start transaction
        $conn->begin_transaction();

        // Step 1: Verify that the Sale exists with the given Sale_id
        $stmt = $conn->prepare("SELECT Sale_id, cust_id, sale_date, tax, shipping FROM Sale WHERE Sale_id = ?");
        $stmt->bind_param("i", $Sale_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            throw new Exception("Sale ID $Sale_id does not exist.");
        }

        // Fetch current data for comparison
        $stmt->bind_result($current_Saleid, $current_cust_id, $current_sale_date, $current_tax, $current_shipping);
        $stmt->fetch();
        $stmt->close();

        // Step 2: If values haven't changed, do nothing and return true
        if ($current_cust_id == $cust_id && $current_sale_date == $saledate && $current_tax == $tax && $current_shipping == $shipping) {
            return true; // No changes to be made
        }

        // Step 3: Update Sale Table with new values (including cust_id)
        $stmt = $conn->prepare("UPDATE Sale SET cust_id = ?, sale_date = ?, tax = ?, shipping = ? WHERE Sale_id = ?");
        $stmt->bind_param("isiii", $cust_id, $saledate, $tax, $shipping, $Sale_id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $conn->rollback();
            throw new Exception("No rows were updated in Sale table for Sale_id: $Sale_id.");
        }
        $stmt->close();

        // Step 4: Retrieve product_id and quantity from SaleItem table
        $stmt = $conn->prepare("SELECT product_id, quantity FROM SaleItem WHERE Sale_id = ?");
        $stmt->bind_param("i", $Sale_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
        } else {
            $conn->rollback();
            throw new Exception("No SaleItem records found for Sale_id: $Sale_id.");
        }
        $stmt->close();

        // Step 5: Retrieve the product listprice
        $stmt = $conn->prepare("SELECT listprice FROM Product WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product_row = $result->fetch_assoc();
            $product_price = $product_row['listprice'];
        } else {
            $conn->rollback();
            throw new Exception("Product not found for product_id: $product_id.");
        }
        $stmt->close();

        // Step 6: Calculate the total price and add tax and shipping
        $calculated_price = ($product_price * $quantity) + $tax + $shipping;

        // Step 7: Update SaleItem with the new sale price
        $stmt = $conn->prepare("UPDATE SaleItem SET saleprice = ? WHERE Sale_id = ?");
        $stmt->bind_param("di", $calculated_price, $Sale_id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $conn->rollback();
            throw new Exception("No rows were updated in SaleItem table for Sale_id: $Sale_id.");
        }
        $stmt->close();

        // Step 8: Commit transaction if all steps succeed
        $conn->commit();
        $conn->close();

        return true; // Return success
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback(); // Rollback in case of error
            $conn->close();
        }
        error_log($e->getMessage()); // Log error for debugging purposes
        throw $e; // Rethrow exception for handling by caller
    }
}




function deleteSale($Sale_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM Sale WHERE Sale_id = ?");
        $stmt->bind_param("i", $Sale_id);
        $success = $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM SaleItem WHERE Sale_id = ?");
        $stmt->bind_param("i", $Sale_id);
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
