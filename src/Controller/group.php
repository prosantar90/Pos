<?php 
/**
 * Extends for new Customers Insert
 */
 class samiti_group extends Database
 {
    public function addGroup($data){
        return $this->insertData('samiti_group', $data);
    }
    // Method to view a customer by ID
    public function getGroupById($id) {
        $sql = "SELECT * FROM samiti_group WHERE id = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all samiti_group
    public function getAllGroups() {
        $sql = "SELECT * FROM samiti_group";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateGroup($data, $id) {
        $data['cus_updated'] = date('Y-m-d H:i:s');
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE samiti_group SET $columns WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteGroup($id) {
        $sql = "DELETE FROM samiti_group WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function searchGroupByName($searchTerm) {
        $sql = "SELECT * FROM samiti_group WHERE customer_name LIKE ? OR phone_number LIKE ? OR id = ?";
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





 }
 