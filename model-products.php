<?php
function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT product_id, product_name, product_description, listprice, color, category FROM `Product`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function InsertProduct($product_name, $product_description, $listprice, $color, $category) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `Product` (`product_name`, `product_description`, `listprice`, `color`, `category`) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("ssdss", $product_name, $product_description, $listprice, $color, $category);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function UpdateProduct($product_id, $product_name, $product_description, $listprice, $color, $category) {
    try {
        $conn = get_db_connection();
        // Prepare the SQL query
        $stmt = $conn->prepare("UPDATE `Product` SET `product_name` = ?, `product_description` = ?, `listprice` = ?, `color` = ?, `category` = ? WHERE `product_id` = ?");
        
        // Check if the statement was prepared correctly
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("ssdssi", $product_name, $product_description, $listprice, $color, $category, $product_id); 
        
        // Execute the statement
        $success = $stmt->execute();
        
        // Close the statement after execution
        $stmt->close();
        
        // Close the connection
        $conn->close();
        
        return $success;
    } catch (Exception $e) {
        // Ensure the connection is closed in case of an error
        if ($conn) {
            $conn->close();
        }
        throw $e; // Rethrow the exception for further handling
    }
}

function deleteProduct($Product_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `Product` WHERE product_id = ?");
        $stmt->bind_param("i", $Product_id); // Use $product_id instead of $sid
        $success = $stmt->execute();
        $stmt->close(); // Close the statement after execution
        $conn->close(); // Close the connection
        return $success;
    } catch (Exception $e) {
        $conn->close(); // Ensure the connection is closed in case of an error
        throw $e; // Rethrow the exception for further handling
    }
}
?>
