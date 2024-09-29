<?php 
/**
 * Extends for new Customers Insert
 */

 class customers extends Database
 {
    public function addCustomer($data){
        return $this->insertData('customers', $data);
    }
    // Method to view a customer by ID
    public function getCustomerById($id) {
        $sql = "SELECT * FROM customers WHERE cum_id = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllCustomers() {
        $sql = "SELECT * FROM customers";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateCustomer($data, $id) {
        $data['cus_updated'] = date('Y-m-d H:i:s');
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE customers SET $columns WHERE cum_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteCustomer($id) {
        $sql = "DELETE FROM customers WHERE cum_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
 }
 