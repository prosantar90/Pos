<?php
class Invoice extends Database {
    // Method to get invoice details
    public function showInvoice($invoice_id) {
        $sql = "SELECT * FROM invoices WHERE invoice_id = ?";
        return $this->getById($sql, $invoice_id);
    }

    // Method to get customer details by invoice ID
    public function getCustomerByInvoice($invoice_id) {
        $sql = "SELECT c.* FROM customers c
                JOIN invoices i ON c.customer_id = i.customer_id
                WHERE i.invoice_id = ?";
        return $this->getById($sql, $invoice_id);
    }

    // Method to insert invoice data
    public function addInvoice($invoiceData) {
        return $this->insertData('invoices', $invoiceData);
    }
    
    // Method to insert customer data
    public function addCustomer($customerData) {
        return $this->insertData('customers', $customerData);
    }
}
