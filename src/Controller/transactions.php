<?php 
/**
 * Extends for new Customers Insert
 */

 class Transaction extends Database
 {
    public function addTransaction($data){
        return $this->insertData('transactions ', $data);
    }
    // Method to view a customer by ID
    public function getTransactionById($id) {
        $sql = "SELECT * FROM  transactions WHERE transaction_id = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAlltransactions() {
        $sql = "SELECT * FROM  transactions";
        return $this->getData($sql); 
    }


    // Method to update customer details
    public function updateTransactions($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE transactions SET $columns WHERE transaction_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteSupplier($id) {
        $sql = "DELETE FROM transactions WHERE transaction_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

 }
 