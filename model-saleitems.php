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

function UpdateSaleItems($Saleitem_id, $product_id, $sale_id, $quantity, $saleprice) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `SaleItem` SET `product_id` = ?, `sale_id` = ?, `quantity` = ?, `saleprice` = ? WHERE `Saleitem_id` = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("iiiii", $product_id, $sale_id, $quantity, $saleprice, $Saleitem_id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
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
