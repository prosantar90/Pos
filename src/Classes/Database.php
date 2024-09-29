<?php 
class Database {
    protected $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    protected function getData($sql, $params = [], $types = '') {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }

    protected function getById($sql, $id) {
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }


     // Function to insert data into any table
    public function insertData($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $values = array_values($data);
        
        // Dynamically generate the type string for bind_param
        $types = str_repeat('s', count($values)); // Assuming all values are strings, modify if you have other types

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $stmt->bind_param($types, ...$values);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return $stmt->insert_id; // Return last inserted ID
        } else {
            return false; // Return false if insertion fails
        }
    }
}


class Sales extends Database {
    public function addSale($data) {
        return $this->insertData('sales', $data);
    }
}

