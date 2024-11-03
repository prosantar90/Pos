<?php 
$supplier = new Supplier($conn);
$transaction = new Transaction($conn);
/**
 * Add Supplier
 * @package
 * Best pos software
 */
if(isset($_POST['add_supplier'])){
    $supplier_name = checkInput($_POST['supplier_name']);
    $supplier_phone = checkInput($_POST['suPphone']);
    $supplier_address = checkInput($_POST['supAddress']);
    $supplier_total_amount = checkInput($_POST['supAmount']);
    $supplier_AdAmount = checkInput($_POST['supAdAmount']);

     if ($supplier->supplierExists($supplier_name)) {
        $_SESSION['res_type'] = 'warning';
        $_SESSION['response'] = 'Supplier already exists';
        header('location:suplier-list.php');
    }
    $data = array(
        'supplier_name'=> $supplier_name,
        'sup_phone'=> $supplier_phone,
        'sup_address'=> $supplier_address,
        'sup_total_amount'=> $supplier_total_amount,
        'sup_ad_amount'=> $supplier_AdAmount,
        'status'       => '1',
    );
    $run = $supplier->addSupplier($data);
    if($run){
        header('location:suplier-list.php');
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Supplier Added Successfully';
    }else{
        // echo 'failed';
        header('location:suplier-list.php');
        $_SESSION['res_type']= 'danger';
        $_SESSION['response ']= 'Something went wrong';
    }
}
/**
 * Delete Supplier
 * @package
 * Best pos software
 */
if(isset($_POST['supl_delete'])){
    $id = checkInput($_POST['supl_delete']);
    $run = $supplier->deleteSupplier($id);
    if($run){
        echo 'ok';
    }else{
        echo 'Something Went wrong';
    }
}
/**
 * View Supplier by id
 * @package
 * Best pos software
 */
$supp_id = '';
$supp_name = '';
$supp_phone = '';
$supp_address = '';
$supp_total_amount = '';
$supp_ad_amount = '';
$supp_due_amount = '';
$sup = false;
 if (isset($_GET['su_view'])) {
   $id = checkInput($_GET['su_view']);
   $row= $supplier->getSupplierById($id);
   $supp_id = $row['sup_ID'];
   $supp_name = $row['supplier_name'];
   $supp_phone = $row['sup_phone'];
   $supp_address = $row['sup_address'];
   $supp_total_amount = $row['sup_total_amount'];
   $supp_ad_amount = $row['sup_ad_amount'];
   $supp_due_amount = $row['sup_due_amount'];
   $sup = true;
 }

 /**
 * View Supplier by id
 * @package
 * Best pos software
 */
if (isset($_POST['up_supplier'])) {
    $id = checkInput($_POST['sup_id']);
    $supp_name = checkInput($_POST['supplier_name']);
    $supplier_phone = (int)checkInput($_POST['suPphone']);
    $supplier_address = checkInput($_POST['supAddress']);
    $supplier_total_amount = checkInput($_POST['supAmount']);
    $supplier_AdAmount = checkInput($_POST['supAdAmount']);
    $data =[
        'supplier_name' => $supp_name,
        'sup_phone'=> $supplier_phone,
        'sup_address'=> $supplier_address,
        'sup_total_amount'=> $supplier_total_amount,
        'sup_ad_amount'=> $supplier_AdAmount,
    ];
    $run = $supplier->updateSupplier($data, $id);    
    if ($run) {
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Supplier Updated Successfully';
        header('location:suplier-list.php');
    } else {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Failed to update supplier';
        header('location:suplier-list.php');
    }
}
/**
 * Active Deactive Suppplier Status
 */
if (isset($_GET['sup_ID'])) {
    $id = checkInput($_GET['sup_ID']);
    $status = checkInput($_GET['status']);
    $bs = "UPDATE supplier  SET status='$status' WHERE sup_ID= '$id'";
    $rs = mysqli_query($conn,$bs);
    header('location:suplier-list.php');
}

/**
 * Export Import  Condition
 */
 if (isset($_POST['export_csv_supplier'])) {
    $filename = 'purchase_data.csv';
    $header = array('SL No', 'Supplier Name', 'Phone', 'Address','Total Amount','Advance Amount','Due Amount','Status','Register Date');
    $query = "SELECT * FROM supplier";
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'product_at', 'd-m-Y');
 }

 if (isset($_POST['import_supplier'])) {
    $file = $_FILES['import_csv_supplier']['tmp_name'];
    $csvMimes = array(
        'text/x-comma-separated-values', 'text/comma-separated-values',
        'application/octet-stream', 'application/vnd.ms-excel',
        'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel', 'text/plain'
    );

    if (in_array($_FILES['import_csv_supplier']['type'], $csvMimes)) {
        $ofile = fopen($file, 'r');
        // Skip the first row (header row)
        $headers = fgetcsv($ofile); // Skip the header row
        
        // Process remaining rows
        while (($data = fgetcsv($ofile, 1000, ',')) !== false) {
            $supplierName = $data[1];
            $supplierPhone = $data[2];
            $supplier_address = $data[3];
            $supplierTotalAmount = $data[4];
            $supplierAdvance = $data[5];
            $supplierDueAmount = $data[6];
            $status = $data[7];
            $register = date('Y-m-d H:i:s', strtotime($data[8]));  

            $supplier_data = [
                'supplier_name' => $supplierName,  // Corrected variable name
                'sup_phone' => $supplierPhone,
                'sup_address' => $supplier_address,
                'sup_total_amount' => $supplierTotalAmount,
                'sup_ad_amount' => $supplierAdvance,
                'sup_due_amount' => $supplierDueAmount,
                'status' => $status,
                'created_at' => $register,
            ];

            // Insert supplier into database
            $run = $supplier->addSupplier($supplier_data);
            if (!$run) {
                // If error occurs, set session message and redirect
                $_SESSION['res_type'] = 'danger';
                $_SESSION['response'] = 'Error inserting supplier: ' . $conn->error;
                header('Location: suplier-list.php');
                exit();
            }
        }

        fclose($ofile);

        // If all suppliers added successfully, set success message and redirect
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Suppliers added successfully';
        header('Location: suplier-list.php');
        exit();

    } else {
        // Invalid file type
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Invalid file type';
        header('Location: suplier-list.php');
        exit();
    }  
}


/**
 * View Supllier Using Ajax
 */
if (isset($_POST['getSupplierId'])) {
    $id = checkInput($_POST['getSupplierId']);
    $run = $supplier->getSupplierById($id);
    if ($run) {
    // Display the image in a circle in the center
    echo '<div class="col-12 mb-4 text-center">';
    if (!empty($run['sup_img'])) {
        echo '<img src="' . $run['sup_img'] . '" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Salesman Image">';
    } else {
        echo '<img src="uploads/default-profile.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Default Image">';
    }
    echo '<div class="balance"><b>Balance: </b>' . 
    (!empty($run['sup_total_amount']) ? $run['sup_total_amount'] : '00') . 
    '</div>';
    echo '</div>';
    // Display the salesman details in two columns

    echo ' <div class="row">
    <div class="col-md-6 cus_leftSide">';
        echo '<p><strong>Name:</strong> ' . $run['supplier_name'] . '</p>';
        echo '<p><strong>Father\'s Name:</strong> ' . $run['sup_phone'] . '</p>';
        echo '<p><strong>Phone:</strong> ' . $run['sup_address'] . '</p>';
        echo '</div>';
        
        echo '<div class="col-md-6">';
        echo '<p><strong>Total Order Amount:</strong> ' . $run['sup_total_amount'] . '</p>';
        echo '<p><strong>Advance Amount:</strong> ' . $run['sup_ad_amount'] . '</p>';
        echo '<p><strong>Due Amount:</strong> ' . $run['sup_due_amount'] . '</p>';
    echo '</div> </div>';
    }
}

if(isset($_POST['search_supplier'])){
    $getId = checkInput($_POST['search_supplier']);
    $run = $supplier->getSupplierById($getId);

    if($run){
        echo '
        <input type="hidden" value="'.$getId.'" name="supID">
        <div class="col-md-4">
            <label>Advance Payment</label>
            <input type="text" name="advance_pay"  class="form-control" placeholder="enter the amount">
        </div>
        <div class="col-md-4">
            <label for="pay_options">Payment Options</label>
            <select class="form-control" name="payment_mod" id="payment_option">
                <option value="">Select payment options</option>
                <option value="hand_cash">Hand Cash</option>
                <option value="bycheque">By Cheque</option>
                <option value="byaccounts">By accounts</option>
            </select>
            <input style="display:none;" id="showInput" name="chequeOrAccountNo" type="text" class="form-control" placeholder="Enter the account or cheque No" >
        </div>

        <div class="col-md-12">
        <input type="submit" class="btn btn-primary" value="Pay Now" name="supplier_pay">
        </div>
        ';
    }
}
if (isset($_POST['supplier_pay'])) {
    $id = checkInput($_POST['supID']);
    $addVanceAmount = checkInput($_POST['advance_pay']);
    $paymentOption = checkInput($_POST['payment_mod']);
    $chequeOrAccountNo = checkInput($_POST['chequeOrAccountNo']);
    $supdata = [
        'sup_ad_amount'=>$addVanceAmount,
    ];
    $runSupData = $supplier->updateSupplier($supdata, $id);
    if ($runSupData) {
        $transactionData = [
                'transaction_type'=> 'suppliers_payment',
                'entity_id'      => $id,
                'amount'         => $addVanceAmount,
                'payment_mode'   => $paymentOption,
                'chequeOraccNo'  => $chequeOrAccountNo,
                'payment_date' => date('Y-m-d H:i:s'),
            ];
            
       $allSucess = $transaction->addTransaction($transactionData);
       if ($allSucess) {
        header('location:supplier-pay.php');
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Supllier Pay Successfully';
       }else{
        header('location:supplier-pay.php');
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Something went wrong';
       }
    }
}