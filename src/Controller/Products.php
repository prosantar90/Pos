<?php 
/**
 * Extends for new Customers Insert
 */

 class Product extends Database
 {
    public function addProducts($data){
        return $this->insertData('products', $data);
    }
    /**
     * Get Product By product_id
     */

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        return $this->getById($sql, $id);
    }
    public function getProductByname($name){
        $sql = "SELECT * FROM products WHERE product_name = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllProduct() {
        $sql = "SELECT * FROM products";
        return $this->getData($sql); 
    }
  public function getProductWithAll(){
    $sql = "SELECT * FROM products";
    return $this->getData($sql);
}


    // Method to update customer details
    public function updateProduct($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE products SET $columns WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by product_id
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function stockAlertProduct(){
        $sql ="SELECT * FROM products WHERE CAST(quantity AS UNSIGNED) < CAST(stock_alert AS UNSIGNED)";
        return $this->getData($sql); 
    }

 }
 