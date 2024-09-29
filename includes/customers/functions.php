<?php
$customer = new customers($conn);

if(isset($_POST['add_customer'])){
    // print_r($_POST);
    $cum_name = checkInput($_POST['cum_name']);
    $cum_f_name = checkInput($_POST['cum_father_name']);
    $cum_phone = checkInput($_POST['cum_phone']);
    $cum_addess = checkInput($_POST['cus_address']);
    $cq = array(
        'customer_name' => $cum_name,
        'father_name' => $cum_f_name,
        'phone_number' => $cum_phone,
        'customer_address' => $cum_addess,
    );
    $run  = $customer->addCustomer($cq);
    if ($run) {
        header('location:customers-frm.php');
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] ='Succefully Inserted';
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
if (isset($_GET['delete_customer'])) {
    $id = checkInput($_GET['delete_customer']);
    $run = $customer->deleteCustomer($id);
    if($run){
        echo 'cool';
    }
}