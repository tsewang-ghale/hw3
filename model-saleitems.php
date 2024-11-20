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

        // Fetch the original quantity and product price (now using 'listprice')
        $query = "SELECT `quantity`, `listprice`, `saleprice` FROM `SaleItem` 
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
        $listprice = $row['listprice'];  // Using 'listprice' now
        $current_saleprice = $row['saleprice'];
        $stmt->close();

        // Calculate the quantity difference
        $quantity_difference = $new_quantity - $original_quantity;

        // Calculate the new sale price
        $new_saleprice = $current_saleprice + ($quantity_difference * $listprice);

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
        $conn = get_db_connection();  // Get the database connection
        
        // Step 1: Get the Sale_id from the SaleItem table using Saleitem_id
        $stmt = $conn->prepare("SELECT sale_id FROM SaleItem WHERE Saleitem_id = ?");
        $stmt->bind_param("i", $Saleitem_id);
        $stmt->execute();
        $stmt->bind_result($sale_id);  // Bind the result to $sale_id
        $stmt->fetch();  // Fetch the result
        $stmt->close();

        
        // Step 2: Delete the SaleItem record
        $stmt = $conn->prepare("DELETE FROM SaleItem WHERE Saleitem_id = ?");
        $stmt->bind_param("i", $Saleitem_id);
        $success = $stmt->execute();
        $stmt->close();
        

        $stmt = $conn->prepare("SELECT COUNT(*) FROM SaleItem WHERE sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->bind_result($item_count);
        $stmt->fetch();
        $stmt->close();

        // If no other SaleItems are associated with the Sale, delete the Sale
        if ($item_count == 0) {
            $stmt = $conn->prepare("DELETE FROM Sale WHERE Sale_id = ?");
            $stmt->bind_param("i", $sale_id);
            $stmt->execute();
            $stmt->close();
        }

        $conn->close();
        return $success;  // Return success if everything went well
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;  // Re-throw the exception to handle it elsewhere
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
