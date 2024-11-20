<?php
function selectSaleItems() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT Saleitem_id, product_id, sale_id, quantity, saleprice FROM `SaleItem`");
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
        $stmt->bind_param("iiii", $product_id, $sale_id, $quantity, $saleprice);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function UpdateSaleItems($Saleitem_id, $product_id, $sale_id, $new_quantity) {
    try {
        $conn = get_db_connection();

        // Fetch the original quantity and product price
        $query = "SELECT `quantity`, `product_price`, `saleprice` FROM `SaleItem` 
                  JOIN `Product` ON `SaleItem`.`product_id` = `Product`.`product_id`
                  WHERE `Saleitem_id` = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare SELECT statement: " . $conn->error);
        }
        $stmt->bind_param("i", $Saleitem_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            throw new Exception("SaleItem not found.");
        }
        $row = $result->fetch_assoc();
        $original_quantity = $row['quantity'];
        $product_price = $row['product_price'];
        $current_saleprice = $row['saleprice'];
        $stmt->close();

        // Calculate the quantity difference
        $quantity_difference = $new_quantity - $original_quantity;

        // Calculate the new sale price
        $new_saleprice = $current_saleprice + ($quantity_difference * $product_price);

        // Update the SaleItem record
        $update_query = "UPDATE `SaleItem` SET `product_id` = ?, `sale_id` = ?, `quantity` = ?, `saleprice` = ? WHERE `Saleitem_id` = ?";
        $stmt = $conn->prepare($update_query);
        if (!$stmt) {
            throw new Exception("Failed to prepare UPDATE statement: " . $conn->error);
        }
        $stmt->bind_param("iiidi", $product_id, $sale_id, $new_quantity, $new_saleprice, $Saleitem_id);
        $success = $stmt->execute();
        $stmt->close();

        $conn->close();
        return $success;
    } catch (Exception $e) {
        if (isset($conn)) {
            $conn->close();
        }
        throw $e;
    }
}


function deleteSaleItems($Saleitem_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `SaleItem` WHERE Saleitem_id = ?");
        $stmt->bind_param("i", $Saleitem_id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT product_id, product_name FROM `Product`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function selectSales() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT sale_id, sale_date FROM `Sale`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
