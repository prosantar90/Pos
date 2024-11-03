<?php 
/**
 * Extends for new Customers Insert
 */

 class Supplier extends Database
 {
    public function addSupplier($data){
        return $this->insertData('supplier', $data);
    }
    // Method to view a customer by ID
    public function getSupplierById($id) {
        $sql = "SELECT * FROM supplier WHERE sup_ID = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllSuppliers() {
        $sql = "SELECT * FROM supplier";
        return $this->getData($sql); 
    }

    public function getAllActiveSuppliers(){
        $sql = "SELECT * FROM supplier WHERE status='1'";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateSupplier($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE supplier SET $columns WHERE sup_ID = ?";
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
        $sql = "DELETE FROM supplier WHERE sup_ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }


    public function supplierExists($supplier_name) {
        $sql = "SELECT supplier_name FROM supplier WHERE supplier_name = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('s', $supplier_name);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function supplierTransaction($id){
   $sql = "
        SELECT * FROM transactions t 
        LEFT JOIN supplier s ON t.entity_id = s.sup_ID 
        WHERE t.transaction_type IN ('purchase_payment', 'suppliers_payment') AND s.sup_ID = ?";

     return $this->getAllDataById($sql, $id);
}

 }
 