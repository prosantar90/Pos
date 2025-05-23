<?php 
/**
 * Extends for new Customers Insert
 */
 class attendance extends Database
 {
    public function addAttendance($data){
        return $this->insertData('group_attendance', $data);
    }
    // Method to view a customer by ID
    public function getAttendanceByid($id) {
        $sql = "SELECT * FROM group_attendance WHERE id = ?";
        return $this->getById($sql, $id);
    }

    // Method to view all group_attendance
    public function getAllAttendance() {
        $sql = "SELECT * FROM group_attendance";
        return $this->getData($sql); 
    }

    // Method to update customer details
    public function updateAttendance($data, $id) {
        $data['attendance_date'] = date('Y-m-d H:i:s');
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE group_attendance SET $columns WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deleteAttendance($id) {
        $sql = "DELETE FROM group_attendance WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

}