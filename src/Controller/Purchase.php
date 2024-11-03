<?php 
/**
 * Extends for new Customers Insert
 */

 class Purchase extends Database
 {
    public function addPurchase($data){
        return $this->insertData('purchase', $data);
    }
    // Method to view a customer by ID
    public function getPurchaseById($id) {
        $sql = "SELECT * FROM purchase WHERE ID = ?";
        return $this->getById($sql, $id);
    }

    public function getAjaxPurchaseById($id){
        $sql ="SELECT * FROM purchase LEFT JOIN products ON purchase.product_id = products.product_id WHERE purchase.ID = ?";
         return $this->getById($sql, $id);
    }

    // Method to view all customers
    public function getAllPurchase() {
        $sql = "SELECT * FROM purchase";
        return $this->getData($sql); 
    }
  public function getPurchaseWithAll(){
    $sql = "SELECT * FROM purchase 
            LEFT JOIN supplier ON purchase.supplier_id = supplier.sup_ID";
    return $this->getData($sql);
    }

public function getAllPurchaseForAjax(){
    $sql = "SELECT purchase.ID, products.product_name,products.product_code  FROM purchase LEFT JOIN products ON purchase.product_id =products.product_id 
         LEFT JOIN supplier ON purchase.supplier_id = supplier.sup_ID
    ";
}


    // Method to update customer details
    public function updatePurchase($data, $id) {
        $columns = implode(" = ?, ", array_keys($data)) . " = ?"; // Generate column placeholders
        $values = array_values($data);
        $values[] = $id;

        $sql = "UPDATE purchase SET $columns WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }

        $types = str_repeat('s', count($data)) . 'i'; 
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    // Method to delete a customer by ID
    public function deletePurchase($id) {
        $sql = "DELETE FROM purchase WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

  public  function get_purchaseInvoice_no(){
     $sql = "SELECT purchase_invoice FROM purchase  ORDER BY purchase_invoice DESC LIMIT 1";
     $getid = $this->getData($sql);
     $invoice_no = 0001;
        foreach ($getid as $id) {
        $invoice_no= $id['purchase_invoice'];
        }
        $invoice_no++;
        $formatted_invoice_no = sprintf('%04d', $invoice_no); 
        return $formatted_invoice_no;
    }


 }
 