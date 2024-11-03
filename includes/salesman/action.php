<?php 
$salesman = new Salesman($conn);
$transaction = new Transaction($conn);
if (isset($_POST['add_salesMan'])) {
//    print_r($_POST);
$salesManName = checkInput($_POST['sale_name']);
$sales_f_Name = checkInput($_POST['sale_f_name']);
$selesPhone  = checkInput($_POST['sale_phone']);
$salesAddress = checkInput($_POST['salesman_address']);
$salesManAccount = checkInput($_POST['salesman_ac']);
$salesBankIfsc = checkInput($_POST['salesman_ifsc']);
$salesManBankName = checkInput($_POST['salesman_bank_name']);
    $salesImage = '';
    if (!empty($_FILES['salesmans_image']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['salesmans_image']['name']);
        move_uploaded_file($_FILES['salesmans_image']['tmp_name'], $targetFile);
        $salesImage = $targetFile;
    }
    $salesManData = [
        'salesman_name' => $salesManName,
        'salesman_f_name' => $sales_f_Name,
        'salesman_phone' => $selesPhone,
        'salesman_address' => $salesAddress,
        // 'balance'          => '0',
        'salesman_acc' => $salesManAccount,
        'salesman_ifsc' => $salesBankIfsc,
        'salesman_bank' => $salesManBankName,
        'salesman_img' => $salesImage,
    ];

    if ($salesman->addSalesman($salesManData)) {
        header('location:salesmans.php');
        $_SESSION['res_type'] ='success';
        $_SESSION['response'] ='Salesman Register successfully';
    } else {
        header('location:salesmans.php');
        $_SESSION['res_type'] ='danger';
        $_SESSION['response'] ='Something went wrong';
    }
}


    $manID = '';
    $manName = '';
    $manFatherName = '';
    $manPhone = '';
    $manAddress = '';
    $manAcc = '';
    $manIfsc = '';
    $manBank = '';
    $manImg = '';
    $manUp = false;
if (isset($_GET['man_edit'])) {
    $id = checkInput($_GET['man_edit']);
    $man = $salesman->getSalesManById($id);
    $manID = $man['ID'];
    $manName = $man['salesman_name'];
    $manFatherName = $man['salesman_f_name'];
    $manPhone = $man['salesman_phone'];
    $manAddress = $man['salesman_address'];
    $manAcc = $man['salesman_acc'];
    $manIfsc = $man['salesman_ifsc'];
    $manBank = $man['salesman_bank'];
    $manImg = $man['salesman_img'];
    $manUp = true;
}

if (isset($_POST['man_delete'])) {
    $manID = checkInput($_POST['man_delete']);
    $salesmanData = $salesman->getSalesManById($manID);
    if ($salesmanData) {
        $imagePath = $salesmanData['salesman_img'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $run = $salesman->deleteSalesMan($manID);
        if ($run) {
            echo 'ok';
        } else {
            echo 'Something went wrong while deleting the salesman record.';
        }
    } else {
        echo 'Salesman not found.';
    }
}


if (isset($_POST['update_salesMan'])) {
    $manID = checkInput($_POST['man_id']);
    $salesManName = checkInput($_POST['sale_name']);
    $sales_f_Name = checkInput($_POST['sale_f_name']);
    $salesPhone = checkInput($_POST['sale_phone']);
    $salesAddress = checkInput($_POST['salesman_address']);
    $salesManAccount = checkInput($_POST['salesman_ac']);
    $salesBankIfsc = checkInput($_POST['salesman_ifsc']);
    $salesManBankName = checkInput($_POST['salesman_bank_name']);
    
    $salesmanData = $salesman->getSalesManById($manID);
    $existingImage = $salesmanData['salesman_img'];
    $salesImage = '';
    if (!empty($_FILES['salesmans_image']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['salesmans_image']['name']);
        move_uploaded_file($_FILES['salesmans_image']['tmp_name'], $targetFile);
        $salesImage = $targetFile;
        if (file_exists($existingImage)) {
            unlink($existingImage);
        }
    } else {
        $salesImage = $existingImage; // Use existing image if no new file is uploaded
    }

    $salesManData = [
        'salesman_name' => $salesManName,
        'salesman_f_name' => $sales_f_Name,
        'salesman_phone' => $salesPhone,
        'salesman_address' => $salesAddress,
        'salesman_acc' => $salesManAccount,
        'salesman_ifsc' => $salesBankIfsc,
        'salesman_bank' => $salesManBankName,
        'salesman_img' => $salesImage
    ];

    if ($salesman->updateSalesMan($salesManData, $manID)) {
        header('location:salesmans.php');
        $_SESSION['res_type'] ='success';
        $_SESSION['response'] ='Salesman updated successfully.';
        
    } else {
          header('location:salesman_frm.php?man_edit='.$manID);
        $_SESSION['res_type'] ='success';
        $_SESSION['response'] ='Salesman updated successfully.';
        echo "Failed to update salesman.";
    }
}


if (isset($_POST['man_view'])) {
    $manID = checkInput($_POST['man_view']);
    $salesmanDetails = $salesman->getSalesManById($manID);
    if ($salesmanDetails) {
    echo '<div class="row text-center">';
    
    // Display the image in a circle in the center
    echo '<div class="col-12 mb-4">';
    if (!empty($salesmanDetails['salesman_img'])) {
        echo '<img src="' . $salesmanDetails['salesman_img'] . '" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Salesman Image">';
    } else {
        echo '<img src="uploads/default-profile.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Default Image">';
    }
    echo '<div class="balance"><b>Balance: </b>' . 
    (!empty($salesmanDetails['balance']) ? $salesmanDetails['balance'] : '00'). 

    '
    <br>
    <b>Paid Amount</b> '.$salesmanDetails['paid_amount'] .'
    
    </div>';

    echo '</div>';

    // Display the salesman details in two columns
    echo '<div class="col-md-6 text-left">';
    echo '<p><strong>Name:</strong> ' . $salesmanDetails['salesman_name'] . '</p>';
    echo '<p><strong>Father\'s Name:</strong> ' . $salesmanDetails['salesman_f_name'] . '</p>';
    echo '<p><strong>Phone:</strong> ' . $salesmanDetails['salesman_phone'] . '</p>';
    echo '<p><strong>Address:</strong> ' . $salesmanDetails['salesman_address'] . '</p>';
    echo '</div>';
    
    echo '<div class="col-md-6 text-left">';
    echo '<p><strong>Bank Account:</strong> ' . $salesmanDetails['salesman_acc'] . '</p>';
    echo '<p><strong>IFSC:</strong> ' . $salesmanDetails['salesman_ifsc'] . '</p>';
    echo '<p><strong>Bank Name:</strong> ' . $salesmanDetails['salesman_bank'] . '</p>';
    echo '</div>';

    echo '</div>'; // Close row
} else {
    echo 'Salesman not found.';
}

}


if (isset($_POST['select_salesmanID'])) {
    $manID= checkInput($_POST['select_salesmanID']);
    $getSalesMan =$salesman->getSalesManById($manID);
    $dueBalance = $getSalesMan['balance'] - $getSalesMan['paid_amount'];
    echo '
            <div class="col-md-4">
                <label>Due Balance</label>
                <input type="text" name="salesMan_due" value="'.$dueBalance.'" class="form-control">
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
            <input type="submit" class="btn btn-primary" value="Pay Now" name="salesMan_pay">
            </div>
    ';
}

if(isset($_POST['salesMan_pay'])){
    $getId = checkInput($_POST['salesman']);
    $dueBalance = checkInput($_POST['salesMan_due']);
    $cusPayMode = checkInput($_POST['payment_mod']);
    $paymentDate = date('Y-m-d');
    $chequeNo = checkInput($_POST['chequeOrAccountNo']);
    $transactionType = 'salesman_payment';
    $data = [
        'transaction_type' => $transactionType,
        'entity_id' => $getId ,
        'amount' => $dueBalance,
        'payment_mode' => $cusPayMode,
        'chequeOraccNo' => !empty($chequeNo) ? $chequeNo :NULL,
        'payment_date' => $paymentDate
    ];
    $run = $transaction->addTransaction($data);
    $invoice_no=  $conn->insert_id;
    if($run){
       $checkCust= $salesman->getSalesManById($getId);
       $oldAmount = $checkCust['paid_amount'];
       $oldDueAmount = $checkCust['due_amount'];
       $current_due_amount = $oldDueAmount - $dueBalance;
       $currentPaidAmount = $oldAmount + $dueBalance;
        $salesManData = [
            'paid_amount' => $currentPaidAmount,
            // 'due_amount' =>$current_due_amount

        ];
        $updateCustomer = $salesman->updateSalesMan($salesManData, $getId);
        if ($updateCustomer) {
           $_SESSION['res_type'] = 'success';
           $_SESSION['response'] = 'Payment Successfull';
        echo  "
            <script>
                    var dataWindow = window.open('includes/invoices/salesman-pay-invoice.php?salesman_pay_invoice=$invoice_no', '_blank');
                    dataWindow.focus();
                    window.location.href = 'salesman-pay.php';
                </script>
        ";
        }else{
            header('location:salesman-pay.php');
           $_SESSION['res_type'] = 'danger';
           $_SESSION['response'] = 'Payment failed';
        }        
    }else{
        header('location:salesman-pay.php');
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Very bad request';
    }
}

/**
 * @package
 */

 if (isset($_POST['export_csv_salesMan'])) {
      $filename = 'salesman_data.csv';
    $header = array('SL No', 'Salesman Name', 'Father Name','Phone No', 'Address', 'Balance', 'Paid Amount', 'Bank Name', 'Account No', 'IFSC Code', 'Image Url','Register date');
    $query = "SELECT ID, salesman_name, salesman_f_name,salesman_phone, salesman_address,balance,paid_amount, salesman_bank, salesman_acc, salesman_ifsc,salesman_img,salesman_at FROM salesman";
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'salesman_at', 'd-m-Y');
 }

 if (isset($_POST['import_salesMan'])) {
    $file = $_FILES['import_csv_salesMan']['tmp_name'];
    $csvMimes = array(
        'text/x-comma-separated-values', 'text/comma-separated-values',
        'application/octet-stream', 'application/vnd.ms-excel',
        'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel', 'text/plain'
    );

    if (in_array($_FILES['import_csv_salesMan']['type'], $csvMimes)) {
        $ofile = fopen($file, 'r');
        // Skip the first row (header row)
        $headers = fgetcsv($ofile);  

        // Process remaining rows
        while (($data = fgetcsv($ofile, 1000, ',')) !== false) {
            $salesmanName = $data[1];
            $fatther_name = $data[2];
            $phone_num = $data[3];
            $salesman_address = $data[4];
            $banlance = $data[5];
            $paid_amount = $data[6];
            $bankName = $data[7];
            $accountNo = $data[8];  
            $ifsc = $data[9]; 
            $image_url = $data[10];
            $register =  date('Y-m-d H:i:s', strtotime($data[11]));

            $salesman_data = [
                'salesman_name' => $salesmanName,
                'salesman_f_name' => $fatther_name,
                'salesman_phone' => $phone_num,
                'salesman_address' => $salesman_address,
                'balance' => $banlance,
                'paid_amount' => $paid_amount,
                'salesman_acc' => $accountNo,
                'salesman_ifsc' => $ifsc,
                'salesman_bank' => $bankName,
                'salesman_img' => $image_url,
                'salesman_at' => $register,
            ];

            // Insert salesman into database
            $run = $salesman->addSalesman($salesman_data);
            if (!$run) {
                $errorMsg = isset($conn->error) ? $conn->error : 'Unknown error';
                $_SESSION['res_type'] = 'danger';
                $_SESSION['response'] = 'Error inserting salesman: ' . $errorMsg;
                header('Location: salesmans.php');
                exit();
            }
        }

        fclose($ofile);
        // Set session success message
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Salesmen added successfully';
        header('Location: salesmans.php');
        exit();
    } else {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Invalid file type';
        header('Location: salesmans.php');
        exit();
    }
}
