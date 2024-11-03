<?php 
/**
 * Extends for new Customers Insert
 */

 class Sales extends Database
 {
    public function addSales($data){
        return $this->insertData(' sales ', $data);
    }
    // Method to view a customer by sales_id
    public function getSalesById($id) {
        $sql = "SELECT * FROM  sales  WHERE sales_id = ?";
        return $this->getById($sql, $id);
    }
    // Method to view all customers
    public function getAllSales() {
        $sql = "SELECT * FROM  sales ";
        return $this->getData($sql); 
    }
    public function updateSales($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?";
        $values = array_values($data);
        $values[] = $id;
        $sql = "UPDATE  sales  SET $columns WHERE sales_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }
    // Method to delete a customer by sales_id
    public function deleteSales($id) {
        $sql = "DELETE FROM  sales  WHERE sales_invoice = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getSalesByInvoice($invoiceNo){
        // $sql = "SELECT sales.sales_invoice,customers.customer_name,customers.phone_number, sales.created_at  FROM sales 
        // LEFT JOIN customers ON 
        // sales.customer_id =customers.cum_id
        // WHERE sales.sales_invoice= ?";
        $sql = "SELECT * FROM `sales` WHERE sales_invoice=? ";
        return $this->getById($sql, $invoiceNo);
    }
 }
