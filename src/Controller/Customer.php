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

    public function searchCustomersByName($searchTerm) {
        $sql = "SELECT * FROM customers WHERE customer_name LIKE ? OR phone_number LIKE ? OR cum_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error preparing statement: ' . $this->conn->error);
        }

        $likeTerm = "%" . $searchTerm . "%";
        $stmt->bind_param('ssi', $likeTerm, $likeTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
/**
 * Get Customer where customer due payment next 10 days
 */
    public function promiseDate(){
        $sql = "SELECT * FROM customers WHERE promis_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 10 DAY) limit 10";
        return $this->getData($sql);    
    }

/**
 * Get customer where new register 
 * 
 */
public function recentCustomers(){
    $sql ="SELECT * FROM customers WHERE created BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND CURDATE() LIMIT 10";
     return $this->getData($sql);
}


/**Get Trasaction report by id */
public function customerTransaction($id){
   $sql = "
        SELECT 
           *
        FROM 
            transactions t 
        LEFT JOIN 
            customers c ON t.entity_id = c.cum_id 
        WHERE 
            t.transaction_type IN ('sales_payment', 'customers_payment') 
            AND c.cum_id = ? ";
     return $this->getAllDataById($sql, $id);
}

 }
 