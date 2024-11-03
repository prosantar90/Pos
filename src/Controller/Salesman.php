<?php 
/**
 * Extends for new Customers Insert
 */

 class Salesman extends Database
 {
    public function addSalesman($data){
        return $this->insertData('salesman ', $data);
    }
    public function getSalesManById($id) {
        $sql = "SELECT * FROM salesman  WHERE ID = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllSaleMans() {
        $sql = "SELECT * FROM salesman ";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateSalesMan($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE salesman  SET $columns WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteSalesMan($id) {
        $sql = "DELETE FROM salesman  WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

     public function salesManTransaction($id){
    $sql = "
        SELECT * FROM transactions t 
        LEFT JOIN salesman s ON t.entity_id = s.ID 
        WHERE t.transaction_type IN ('salesman_payment') AND s.ID = ?";

     return $this->getAllDataById($sql, $id);
    }
 
}
