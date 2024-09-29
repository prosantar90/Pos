<?php
if (! session_start()) {
    session_start();
}
include 'config/config.php';
function checkInput($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data);
    return $data;
}
require_once 'functions.php';
require_once 'src/includes.php';
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    // print_r($_POST);
    $username = checkInput($_POST['username']);
    $pass     = checkInput(sha1($_POST['pass']));
    $query    = "SELECT * FROM users WHERE user_name=? AND user_pass=?";
    $stmt     =$conn->prepare($query);
    $stmt->bind_param('ss', $username, $pass);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user != NULL) {
        $_SESSION['username'] = $username;
        echo 'ok';
        if (!empty($_POST['rem'])) {
           setcookie('username', $_POST['username'], time()+ (10*365*24*60*60));
           setcookie('pass', $_POST['pass'], time()+ (10*365*24*60*60));
        }else{
            if (isset($_COOKIE['username'])) {
                setcookie('username', '');
            }
            if (isset($_COOKIE['pass'])) {
                setcookie('pass', '');
            }
        }
    }else{
        echo "Something went wrong please try again";
    }
}

// 
if (isset($_POST['add_user'])) {
    // print_r($_POST);
    $uFullname = checkInput($_POST['ufname']);
    $uname = checkInput($_POST['uname']);
    $uemail = checkInput($_POST['uemail']);
    $upass = checkInput(sha1($_POST['upass']));
    $ucpass = checkInput(sha1($_POST['ucpass']));
    $utype = checkInput($_POST['utype']);
    $uphoto = $_FILES['uphoto']['name'];
    $upupload = 'uploads/'.$uphoto;
    
    if ($ucpass != $upass) {
        echo 'Password did not match';
        exit;
    }else{
        $q = "SELECT user_name, user_email FROM users WHERE user_name=? Or user_email=?";
        $stmt= $conn->prepare($q);
        $stmt->bind_param("ss",$uname, $uemail);
        $stmt->execute();
        $stmt->store_result();
        //    if ( $row['user_name']==$uname) {
        if ($stmt->num_rows > 0) {
            header("location:user_frm.php");
                $_SESSION['res_type'] ="danger";
                $_SESSION['response'] ="Username not available";
            }elseif($stmt->num_rows > 0) {
                 header("location:user_frm.php");
                $_SESSION['res_type'] ="danger";
                $_SESSION['response'] ="Email Not availble";
            }else{
               $sql = "INSERT INTO users(user_name, ufname, user_pass, user_email, user_role, u_photo) VALUES ('$uname','$uFullname','$upass','$uemail','$utype','$upupload')";
                $run = mysqli_query($conn, $sql);
                move_uploaded_file($_FILES['uphoto']['tmp_name'], $upupload);
                if ($run) {
                    
                    header("location:user_frm.php");
                    $_SESSION['res_type'] ="success";
                    $_SESSION['response'] ="User Added sucessfully";
                }else{
                    echo 'Something went wrong'. $conn->error;

                }
            }
        
    }
}


// Update Product 
require_once 'includes/users/functions.php';
// require_once 'includes/users/users_lists.php';
include 'includes/products/functions.php';
include 'includes/category/functions.php';
include 'includes/brand/functions.php';
include 'includes/unit/functions.php';
include 'includes/users/functions.php';
include 'includes/customers/functions.php';

//  Sales Functions;
if (isset($_POST['sub_sale'])) {
    $pr_id = $_POST['pro_id'];
    $customer_id = 2;
    $sal_qty = $_POST['sal_qty'];
    $sal_price = $_POST['sal_price'];
    $sal_total = $_POST['sal_total'];
    
    foreach ($pr_id as $key => $product_id) {
        $pro_id = $product_id;
        $sales_qty = $sal_qty[$key];
        $sales_price = $sal_price[$key];
        $sales_total = $sal_total[$key];
        $sq ="INSERT INTO sales(customer_id, product_id, sales_qty, sales_price, sales_total_amount) VALUES (?,?,?,?,?)";
        $ss= $conn->prepare($sq);
        $ss->bind_param('issss', $customer_id, $pro_id, $sales_qty, $sales_price, $sales_total);
        $ss->execute();
    }
}

if (isset($_GET['pro_code'])) {
    $code = checkInput($_GET['pro_code']);
    $row=getProductByCode($code);
    echo json_encode($row);
}
if (isset($_POST['sales_btn'])) {
    $invoice_no = checkInput($_POST['invoice_no']);
    $customer_name = checkInput($_POST['cum_name']);
    $customer_fatherName = checkInput($_POST['cum_father']);
    $customer_phone = checkInput($_POST['cum_phone']);
    $cum_addr = checkInput($_POST['address']);
    $order_amount = checkInput($_POST['sub_total']);
    $order_amount_paid = checkInput($_POST['paid-amount']);
    $grand_total = $order_amount - $order_amount_paid;
    $order_total_amount_due = $grand_total;
    $_SESSION['form_data'] = $_POST;
    if (empty($customer_name) || empty($customer_fatherName) || empty($cum_addr)) {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Please enter Customer details fields';
        header('location: sales-frm.php');
        exit();
    }
    $cumQuery = "INSERT INTO customers (customer_name, father_name, phone_number, customer_address, order_amount, order_amount_paid, order_total_amount_due) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $cumStmt = $conn->prepare($cumQuery);
    $cumStmt->bind_param('sssssss', $customer_name, $customer_fatherName, $customer_phone, $cum_addr, $order_amount, $order_amount_paid, $order_total_amount_due);
    $cumStmt->execute();
    
    $cum_id = $conn->insert_id;
    if ($cum_id > 0) {
        // Process products and insert them into sales
        $product_names = $_POST['product_name'];
        $product_price = $_POST['product_qty'];
        $product_qty = $_POST['product_price'];
        $product_total = $_POST['product_total'];

        foreach ($product_names as $key => $pname) {
            $pname = $pname;
            $pprice = $product_price[$key];
            $pqty = $product_qty[$key];
            $ptotal = $product_total[$key];

            $pq = "INSERT INTO sales (customer_id,sales_invoice, product_id, sales_qty, sales_price, sales_total_amount) VALUES (?,?, ?, ?, ?, ?)";
            $pst = $conn->prepare($pq);
            $pst->bind_param('ssssss', $cum_id, $invoice_no, $pname, $pprice, $pqty, $ptotal);
            $pst->execute();
        }

        // header('location:sales-frm.php');
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Sales generated successfully';
         echo "<script>
            // Open the new window to show current entered data (e.g., invoice-print.php)
            var dataWindow = window.open('includes/invoices/sales-print.php?invoice=$invoice_no', '_blank');
            dataWindow.focus();

            // Open the form page in the current window but reset the form
            window.location.href = 'sales-frm.php';
          </script>";

          unset($_SESSION['form_data']);

    
    } else {
        header('location:sales-frm.php');
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Something went wrong';
    }
}


if (isset($_GET['invoice'])) {
    $invoice_no = checkInput($_GET['invoice']);
    $sql = "SELECT * FROM sales 
    LEFT JOIN customers ON 
    sales.customer_id =customers.cum_id
     WHERE sales.sales_invoice= ?";
    $row= byId($sql, $invoice_no);
    $invoice_no =  $row['sales_invoice'];
    $customer_name = $row['customer_name'];
    $phone_number = $row['phone_number'];
    $invoice_created = $row['created_at'];
    
}