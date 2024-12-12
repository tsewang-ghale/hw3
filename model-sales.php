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

        // Step 4: Proceed with updating SaleItems or any additional logic
        // This part seems to be working fine, but you can verify and test the logic for SaleItems

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
