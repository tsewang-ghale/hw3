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
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

function selectCustomersPurchase($custId) {
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
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $custId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

function InsertCustomerWithPurchase($cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email) {
    try {
        $conn = get_db_connection();
        $conn->begin_transaction();

        // Insert into Customer table
        $stmt = $conn->prepare("INSERT INTO `Customer` (`cust_firstname`, `cust_lastname`, `cust_address`, `cust_phone`, `cust_email`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting customer: " . $stmt->error);
        }
        $cust_id = $stmt->insert_id;
        $stmt->close();

        // Insert purchase details (example structure)
        $stmt = $conn->prepare("INSERT INTO `Sale` (`cust_id`) VALUES (?, ?)");
        $stmt->bind_param("i", $cust_id);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting purchase: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit();
        $conn->close();
        return true;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback();
            $conn->close();
        }
        throw $e;
    }
}

function UpdateCustomerWithPurchase($cust_id, $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email) {
    try {
        $conn = get_db_connection();
        $conn->begin_transaction();

        // Update Customer table
        $stmt = $conn->prepare("UPDATE `Customer` SET `cust_firstname` = ?, `cust_lastname` = ?, `cust_address` = ?, `cust_phone` = ?, `cust_email` = ? WHERE `cust_id` = ?");
        $stmt->bind_param("sssssi", $cust_firstname, $cust_lastname, $cust_address, $cust_phone, $cust_email, $cust_id);
        if (!$stmt->execute()) {
            throw new Exception("Error updating customer: " . $stmt->error);
        }
        $stmt->close();

        // Update purchase details (example structure)
        $stmt = $conn->prepare("UPDATE `Sale` WHERE `cust_id` = ?");
        $stmt->bind_param("i" $cust_id);
        if (!$stmt->execute()) {
            throw new Exception("Error updating purchase: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit();
        $conn->close();
        return true;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback();
            $conn->close();
        }
        throw $e;
    }
}

function DeleteCustomerWithPurchase($cust_id) {
    try {
        $conn = get_db_connection();
        $conn->begin_transaction();

        // Delete purchase details (example structure)
        $stmt = $conn->prepare("DELETE FROM `Sale` WHERE `cust_id` = ?");
        $stmt->bind_param("i", $cust_id);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting purchase: " . $stmt->error);
        }
        $stmt->close();

        // Delete from Customer table
        $stmt = $conn->prepare("DELETE FROM `Customer` WHERE `cust_id` = ?");
        $stmt->bind_param("i", $cust_id);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting customer: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit();
        $conn->close();
        return true;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback();
            $conn->close();
        }
        throw $e;
    }
}
?>
