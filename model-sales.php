function UpdateSale($sale_id, $saledate, $tax, $shipping) {
    try {
        $conn = get_db_connection();
        $conn->begin_transaction(); // Start transaction

        // Step 1: Update Sale Table
        $stmt = $conn->prepare("UPDATE `Sale` SET `sale_date` = ?, `tax` = ?, `shipping` = ? WHERE `sale_id` = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare Sale update statement: " . $conn->error);
        }
        $stmt->bind_param("siii", $saledate, $tax, $shipping, $sale_id);
        $stmt->execute();
        $stmt->close();

        // Step 2: Retrieve product_id, quantity from SaleItem
        $stmt = $conn->prepare("SELECT product_id, quantity FROM SaleItem WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SaleItem select statement: " . $conn->error);
        }
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("No SaleItem found for sale_id: " . $sale_id);
        }
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $stmt->close();

        // Step 3: Retrieve product listprice from Product table
        $stmt = $conn->prepare("SELECT listprice FROM Product WHERE product_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare Product select statement: " . $conn->error);
        }
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Product not found for product_id: " . $product_id);
        }
        $product_row = $result->fetch_assoc();
        $product_price = $product_row['listprice'];
        $stmt->close();

        // Step 4: Calculate total price and update SaleItem
        $calculated_price = ($product_price * $quantity) + $tax + $shipping;

        $stmt = $conn->prepare("UPDATE SaleItem SET saleprice = ? WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SaleItem update statement: " . $conn->error);
        }
        $stmt->bind_param("di", $calculated_price, $sale_id);
        $stmt->execute();
        $stmt->close();

        $conn->commit(); // Commit the transaction
        $conn->close();

        return true;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback(); // Rollback on error
            $conn->close();
        }
        throw new Exception("UpdateSale failed: " . $e->getMessage());
    }
}

function deleteSale($sale_id) {
    try {
        $conn = get_db_connection();
        $conn->begin_transaction();

        // Delete from SaleItem first (if necessary)
        $stmt = $conn->prepare("DELETE FROM `SaleItem` WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SaleItem delete statement: " . $conn->error);
        }
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->close();

        // Delete from Sale
        $stmt = $conn->prepare("DELETE FROM `Sale` WHERE sale_id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare Sale delete statement: " . $conn->error);
        }
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        $conn->close();

        return true;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback();
            $conn->close();
        }
        throw new Exception("deleteSale failed: " . $e->getMessage());
    }
}

