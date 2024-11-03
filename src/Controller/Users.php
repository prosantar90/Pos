<?php 
/**
 * Extends for new Customers Insert
 */

 class Users extends Database
 {
    public function addUser($data){
        return $this->insertData('users', $data);
    }
    // Method to view a customer by ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateCustomer($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?";
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE users SET $columns WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
 }
 