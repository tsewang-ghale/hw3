function selectSaleItems() {
    try {
        $conn = get_db_connection();  // Assuming this function gets a database connection
        // Correct SQL query with the missing comma
        $stmt = $conn->prepare("SELECT product_id, sale_id, quantity, saleprice, COUNT(Saleitem_id) AS count_saleitem FROM saleitems GROUP BY product_id, sale_id, quantity, saleprice");
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
