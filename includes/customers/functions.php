<?php
$customer = new customers($conn);
$transaction = new Transaction($conn);
if(isset($_POST['add_customer'])){
 date_default_timezone_set('Asia/Kolkata');
    $cum_name = checkInput($_POST['cum_name']);
    $cum_f_name = checkInput($_POST['cum_father_name']);
    $cum_phone = checkInput($_POST['cum_phone']);
    $cum_addess = checkInput($_POST['cus_address']);
    
    $cq = array(
        'customer_name' => $cum_name,
        'father_name' => $cum_f_name,
        'phone_number' => $cum_phone,
        'customer_address' => $cum_addess,
        'cus_updated'   => date('Y-m-d H:i:s'),
    );
    
    try {
        $run  = $customer->addCustomer($cq);
        if ($run) {
            $_SESSION['res_type'] = 'success';
            $_SESSION['response'] = 'Successfully Inserted';
        } else {
            $_SESSION['res_type'] = 'danger';
            $_SESSION['response'] = 'Failed to insert data';
        }
        header('location:customers-frm.php');
    } catch (Exception $e) {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'SQL Error: ' . $e->getMessage();
        header('location:customers-frm.php');
    }
}


  
   $cus_id = '';
   $cus_name = '';
   $cus_f_name = '';
   $cus_phone = '';
   $cus_address = '';
   $cus_amount = '';
   $cus_amount_paid = '';
   $cus_amount_due = '';
   $customer_update = false; 
/**
 * View Customer 
 * @package
 * Best pos software
 */
if (isset($_GET['cum_id'])) {
   $id = checkInput($_GET['cum_id']);
   $row = $customer->getCustomerById($id);
   $cus_id = $row['cum_id'];
   $cus_name = $row['customer_name'];
   $cus_f_name = $row['father_name'];
   $cus_phone = $row['phone_number'];
   $cus_address = $row['customer_address'];
   $cus_amount = $row['order_amount'];
   $cus_amount_paid = $row['order_amount_paid'];
   $cus_amount_due = $row['order_total_amount_due'];
   $customer_update = true; 
}
/**This is for Sales form get details */
if(isset($_POST['customer_id'])){
    $id = checkInput($_POST['customer_id']);
    $row =$customer->getCustomerById($id);
    if($row) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Customer not found']);
    }
}

/**
 * This is for customer pay like pending and paid balance
 */
if (isset($_POST['search_customer'])) {
   $id = checkInput($_POST['search_customer']);
   $run =$customer->getCustomerById($id);
   if($run){
        echo '
        <input type="hidden" value="'.$id.'" name="custID">
        <div class="col-md-4">
            <label>Due Balance</label>
            <input type="text" name="customer_due" value="'.$run['order_total_amount_due'].'" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="pay_options">Payment Options</label>
            <select class="form-control" name="payment_mod" id="payment_option">
                <option value="">Select payment options</option>
                <option value="hand_cash">Hand Cash</option>
                <option value="bycheque">By Cheque</option>
                <option value="byaccounts">By accounts</option>
            </select>
                <input style="display:none;" id="showInput" name="chequeOrAccountNo" type="text" class="form-control mt-2" placeholder="Enter the account or cheque No">
        </div>

        <div class="col-md-12">
        <input type="submit" class="btn btn-primary" value="Pay Now" name="customer_pay">
        </div>
        ';
    }
   
}


/**
 * Update Customer 
 * @package
 * Best pos software
 */

 if (isset($_POST['update_customer'])) {
    // print_r($_POST);
    $cust_id = checkInput($_POST['cus_id']);
    $cust_name = checkInput($_POST['cum_name']);
    $cust_f_name = checkInput($_POST['cum_father_name']);
    $cust_phone = checkInput($_POST['cum_phone']);
    $cust_address = checkInput($_POST['cus_address']);
    $cust_total_amount = checkInput($_POST['cus_t_amount']);
    $cust_amount_paid = checkInput($_POST['cus_amount_paid']);
    $cust_amount_due = checkInput($_POST['cus_due_amount']);
    $current_paid_amount = $cust_amount_paid + $cust_amount_due;  
    $current_due_amount =   $cust_total_amount- $current_paid_amount;

    $cudate_data = [

        'customer_name' => $cust_name,
        'father_name' => $cust_f_name,
        'phone_number' => $cust_phone,
        'customer_address' => $cust_address,
        'order_amount' => $cust_total_amount,
        'order_amount_paid' => $current_paid_amount,
        'order_total_amount_due' => $current_due_amount,

    ];

    $run = $customer->updateCustomer($cudate_data, $cust_id);
    if($run){
        header('location:customers-frm.php');
        $_SESSION['res_type'] ='success';
        $_SESSION['response'] ='Customer Update successfully';
    }

 }
 /**
 * Delete Customer 
 * @package
 * Best pos software
 */
if (isset($_POST['delete_customer'])) {
    $id = checkInput($_POST['delete_customer']);
    $run = $customer->deleteCustomer($id);
    if($run){
        echo 'ok';
    }
}
 /**
 * Search Customer By name
 * @package
 * Best pos software
 */
if (isset($_POST['findCusByName'])) {
    $query = $_POST['findCusByName'];
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $result = $customer->searchCustomersByName($query);
    if ($result) {
        foreach ($result as $row) {
            if ($page === 'sales-frm') {
                 echo '<li data-id="'.$row['cum_id'].'" data-name="'.$row['customer_name'].'" class="list-group-item customer-item">' .$row['cum_id'].'| '. $row['customer_name'] . '</li>';
            }else{
                 echo '<li data-id="'.$row['cum_id'].'" data-name="'.$row['customer_name'].'" class="list-group-item customer-pay-item">' .$row['cum_id'].'| '. $row['customer_name'] . '</li>';
            }
        }
    } else {
      echo '';
    }
}


/**
 * Export Customers
 * 
 */
if (isset($_POST['export_csv_customers'])) {
    $filename = 'customers_data.csv';
    $header = array('SL No', 'Name', 'Father Name', 'Address', 'Phone Number', 'Total Amount', 'Paid Amount', 'Due Amount', 'Register', 'Last Update');
    $query = "SELECT * FROM customers ORDER BY cum_id DESC";
    
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'cus_updated', 'd-m-Y');
}

/**
 * Import Customers
 * 
 */
 if (isset($_POST['import_customers'])) {
    $file = $_FILES['import_csv_customers']['tmp_name'];
    $csvMimes = array(
        'text/x-comma-separated-values', 'text/comma-separated-values',
        'application/octet-stream', 'application/vnd.ms-excel',
        'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel', 'text/plain'
    );
    if (in_array($_FILES['import_csv_customers']['type'], $csvMimes)) {
        $ofile = fopen($file, 'r');
        // Skip the first row (header row)
        $headers = fgetcsv($ofile);  // This reads the first row but doesn't process it.
        // Process remaining rows
        while (($data = fgetcsv($ofile, 1000, ',')) !== false) {
            echo $customer_name = $data[1];
           
            
            $fatther_name = $data[2];
            $phone_num = $data[3];
            $customer_address = $data[4];
            $order_amount = $data[5];
            $paid_amount = $data[6];
            $dueAmount = $data[7];
            $register = date('Y-m-d H:i:s', strtotime($data[8]));  
            $lastPurchase = date('Y-m-d H:i:s', strtotime($data[9])); 
            $promiseDate = $data[10];

            $customers_data = [
                'customer_name' => $customer_name,
                'father_name' => $fatther_name,
                'phone_number' => $phone_num,
                'customer_address' => $customer_address,
                'order_amount' => $order_amount,
                'order_amount_paid' => $paid_amount,
                'order_total_amount_due' => $dueAmount,
                'created' => $register,
                'cus_updated' => $lastPurchase,
                'promis_date' => $promiseDate,
            ];

            // Insert product into database
            $run = $customer->addCustomer($customers_data);
            if (!$run) {
                // echo "Error inserting product '$customer_name': " . $conn->error . "<br>";
                $_SESSION['res_type'] = 'danger';
                $_SESSION['response'] = 'Error inserting product' . $conn->error . "<br>";;
                header('Location: customers.php');
            }
        }

        fclose($ofile);
        // Set session success message
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Customer added successfully';
        header('Location: customers.php');
        exit();
    } else {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Invalid file type' . $conn->error . "<br>";;
        header('Location: customers.php');
    }  
 }

/**
 * Get Customer Details Using ajax
 */
if(isset($_POST['getCustomerId'])){
    $id = checkInput($_POST['getCustomerId']);
    $run = $customer->getCustomerById($id);
    if ($run) {
    // Display the image in a circle in the center
    echo '<div class="col-12 mb-4 text-center">';
    if (!empty($run['salesman_img'])) {
        echo '<img src="' . $run['salesman_img'] . '" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Salesman Image">';
    } else {
        echo '<img src="uploads/default-profile.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Default Image">';
    }
    echo '<div class="balance"><b>Balance: </b>' . 
    (!empty($run['order_amount']) ? $run['order_amount'] : '00') . 
    '</div>';
    echo '</div>';
    // Display the salesman details in two columns

    echo ' <div class="row">
    <div class="col-md-6 cus_leftSide">';
        echo '<p><strong>Name:</strong> ' . $run['customer_name'] . '</p>';
        echo '<p><strong>Father\'s Name:</strong> ' . $run['father_name'] . '</p>';
        echo '<p><strong>Phone:</strong> ' . $run['phone_number'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $run['customer_address'] . '</p>';
        echo '</div>';
        
        echo '<div class="col-md-6">';
        echo '<p><strong>Total Order Amount:</strong> ' . $run['order_amount'] . '</p>';
        echo '<p><strong>Paid Amount:</strong> ' . $run['order_amount_paid'] . '</p>';
        echo '<p><strong>Due Amount:</strong> ' . $run['order_total_amount_due'] . '</p>';
    echo '</div> </div>';
    }
}


/**
 *Customer pay
 */
if(isset($_POST['customer_pay'])){
    $cusID = checkInput($_POST['custID']);
    $custDuePayment = checkInput($_POST['customer_due']);
    $cusPayMode = checkInput($_POST['payment_mod']);
    $paymentDate = date('Y-m-d');
    $chequeNo = checkInput($_POST['chequeOrAccountNo']);
    $transactionType = 'customers_payment';
    $data = [
        'transaction_type' => $transactionType,
        'entity_id' => $cusID,
        'amount' => $custDuePayment,
        'payment_mode' => $cusPayMode,
        'chequeOraccNo' => !empty($chequeNo) ? $chequeNo :NULL,
        'payment_date' => $paymentDate
    ];
    $run = $transaction->addTransaction($data);
    $invoice_no=  $conn->insert_id;

    if($run){
       $checkCust= $customer->getCustomerById($cusID);
       $oldAmount = $checkCust['order_amount_paid'];
       $oldDueAmount = $checkCust['order_total_amount_due'];
       $current_due_amount = $oldDueAmount - $custDuePayment;
       $currentPaidAmount = $oldAmount + $custDuePayment;
        $cusData = [
            'order_amount_paid' => $currentPaidAmount,
            'order_total_amount_due' =>$current_due_amount

        ];
        $updateCustomer = $customer->updateCustomer($cusData, $cusID);
        if ($updateCustomer) {
        //    header('location:customer_pay.php');
           $_SESSION['res_type'] = 'success';
           $_SESSION['response'] = 'Payment Successfull';
        echo  "
            <script>
                    var dataWindow = window.open('includes/invoices/customer-pay-invoice.php?customer_pay_invoice=$invoice_no', '_blank');
                    dataWindow.focus();
                    window.location.href = 'customer_pay.php';
                </script>
        ";

        }else{
            header('location:customer_pay.php');
           $_SESSION['res_type'] = 'danger';
           $_SESSION['response'] = 'Payment failed';
        }        
    }else{
        header('location:customer_pay.php');
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Very bad request';
    }
}




