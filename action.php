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
include 'functions.php';
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

// Add Product 
if (isset($_POST['add_product'])) {
    $pname= checkInput($_POST['product_name']);
    $pcode= checkInput($_POST['product_code']);
    $brand= checkInput($_POST['brand']);
    $pcat= checkInput($_POST['p_cat']);
    $sales_unit= checkInput($_POST['sales_unit']);
    $stock_alert= checkInput($_POST['stock_alert']);
    $pprice= checkInput($_POST['price']);
    $pquantity= checkInput($_POST['quantity']);
    $pimage = $_FILES['p_image']['name'];
    $upload = 'uploads/'.$pimage;
    $q = "INSERT INTO products(product_name, product_code, brand, p_cat, sales_unit, stock_alert, price, quantity, p_image) values(?,?,?,?,?,?,?,?,?)";
    $stmt= $conn->prepare($q);
    $stmt->bind_param('sssssssss',$pname,$pcode,$brand, $pcat,$sales_unit,$stock_alert,$pprice,$pquantity,$upload);
     $stmt->execute();
    move_uploaded_file($_FILES['p_image']['tmp_name'],$upload);
    header('location:product-frm.php');
    $_SESSION['response'] = 'Product Added Successfully';
    $_SESSION['res_type'] = 'success'; 
}
// Delete queries
if (isset($_GET['p_delete'])) {
    $id = checkInput($_GET['p_delete']);
    $ps2= "SELECT p_image FROM products WHERE products.product_id=?";
    $ps2=$conn->prepare($ps2);
    $ps2->bind_param('i', $id);
    $ps2->execute();
    $pr= $ps2->get_result();
    $op= $pr->fetch_assoc();
    $imagepath=$op['p_image'];
    unlink($imagepath);

    $ps = "DELETE FROM products WHERE products.product_id= ?";
    $dp=$conn->prepare($ps);
    $dp->bind_param('i',$id);
    $dp->execute();
    header('location:product-list.php');
     $_SESSION['response'] = 'Product deleted Successfully';
    $_SESSION['res_type'] = 'danger'; 
}
    $pr_update= false;
    $pr_id=   '';
    $pr_name= '';
    $pr_code= '';
    $pr_unit= '';
    $br_id= '';
    $pr_cat= '';
    $pr_unit = '';
    $pr_stock = '';
    $pr_price = '';
    $pr_qty = '';
    $pr_image ='';
if (isset($_GET['p_view'])) {
    $id = checkInput($_GET['p_view']);
    // print_r($_GET);
    $pv= "SELECT products.product_id, products.product_name, products.product_code, products.brand, products.p_cat, products.sales_unit, products.stock_alert,brand.brand_name, units.unit_name, categories.category_name, products.price,products.quantity, products.p_image FROM products 
        LEFT JOIN brand ON products.brand= brand.b_id
        LEFT JOIN units ON products.sales_unit= units.unit_id
        LEFT JOIN categories ON products.p_cat= categories.cat_id
        WHERE products.product_id=?";
    $ps= $conn->prepare($pv);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
    
    $pr_id= $row['product_id'];
    $pr_name= $row['product_name'];
    $pr_code= $row['product_code'];
    $pr_unit= $row['unit_name'];
    $br_id= $row['brand'];
    $pr_cat= $row['p_cat'];
    $pr_unit = $row['sales_unit'];
    $pr_stock = $row['stock_alert'];
    $pr_price = $row['price'];
    $pr_qty = $row['quantity'];
    $pr_image =$row['p_image'];
    $pr_update = true;
}
// Ajax product View
if (isset($_GET['pr_view'])) {
    $id = checkInput($_GET['pr_view']);
    $pv= "SELECT products.product_id, products.product_name, products.product_code, products.brand, products.p_cat, products.sales_unit, products.stock_alert,brand.brand_name, units.unit_name, categories.category_name, products.price,products.quantity, products.p_image FROM products 
        LEFT JOIN brand ON products.brand= brand.b_id
        LEFT JOIN units ON products.sales_unit= units.unit_id
        LEFT JOIN categories ON products.p_cat= categories.cat_id
        WHERE products.product_id=?";
    $ps= $conn->prepare($pv);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
    if ($row >0 ) {
        echo json_encode($row);
    }
}
// Update Product 
if (isset($_POST['up_product'])) {
    $id = checkInput($_POST['pr_id']);
    $pname= checkInput($_POST['product_name']);
    $pcode= checkInput($_POST['product_code']);
    $brand= checkInput($_POST['brand']);
    $pcat= checkInput($_POST['p_cat']);
    $sales_unit= checkInput($_POST['sales_unit']);
    $stock_alert= checkInput($_POST['stock_alert']);
    $pprice= checkInput($_POST['price']);
    $pquantity= checkInput($_POST['quantity']);
    // $pimage = $_FILES['p_image']['name'];
    $oldimage = checkInput($_POST['oldprimg']);

    if(isset($_FILES['p_image']['name']) && ($_FILES['p_image']['name'] !='')){
        $newimage ="uploads/".$_FILES['p_image']['name'];
        if (file_exists($oldimage)) {
         unlink($oldimage);
        }
        // unlink($oldimage);
        move_uploaded_file($_FILES['p_image']['tmp_name'],$newimage);
    }else{
        $newimage =$oldimage;
    }
    $query = "UPDATE products SET product_name=?, product_code=?, brand=?, p_cat=?, sales_unit=?, stock_alert=?, price=?, quantity=?, p_image=? WHERE product_id=?";
    $stmt= $conn->prepare($query);
    $stmt->bind_param('sssssssssi',$pname,$pcode,$brand, $pcat,$sales_unit,$stock_alert,$pprice,$pquantity,$newimage, $id);
    $stmt->execute();
    header('location:product-frm.php?p_view='.$id);
     $_SESSION['response'] = 'Product Updated Successfully';
    $_SESSION['res_type'] = 'success'; 
}

include 'includes/category/functions.php';
include 'includes/brand/functions.php';
include 'includes/unit/functions.php';
// Status update
if (isset($_GET['b_id'])) {
    $id = checkInput($_GET['b_id']);
    $status = checkInput($_GET['status']);
    $bs = "UPDATE brand SET brand_status='$status' WHERE b_id= '$id'";
    $rs = mysqli_query($conn,$bs);
    header('location:brands.php');
}
if (isset($_GET['cat_id'])) {
    $id = checkInput($_GET['cat_id']);
    $status = checkInput($_GET['status']);
    $bs = "UPDATE categories SET cat_status='$status' WHERE cat_id= '$id'";
    $rs = mysqli_query($conn,$bs);
    header('location:category.php');
}

if (isset($_GET['unit_id'])) {
    $id = checkInput($_GET['unit_id']);
    $status = checkInput($_GET['status']);
    $bs = "UPDATE units  SET unit_status='$status' WHERE unit_id= '$id'";
    $rs = mysqli_query($conn,$bs);
    header('location:units.php');
}


// Profile Update using
if (isset($_POST['uUpdate'])) {
    $username = $_POST['uid'];
    $fullName = checkInput($_POST['fullName']);
    $uabout = checkInput($_POST['uabout']);
    $ucom   =checkInput($_POST['ucompany']);
    $ucom_regd_no= checkInput($_POST['cregd_no']);
    $ucountry= checkInput($_POST['ucountry']);
    $uAddress =checkInput($_POST['uaddress']);
    $uPhone = checkInput($_POST['uphone']);
    $uemail =checkInput($_POST['uemail']);
    $oldimage  = $_POST['oldimage'];
    if(isset($_FILES['u_photo']['name']) && ($_FILES['u_photo']['name'] !='')){
        $newimage ="uploads/".$_FILES['u_photo']['name'];
        if (file_exists($oldimage)) {
         unlink($oldimage);
        }
        // unlink($oldimage);
        move_uploaded_file($_FILES['u_photo']['tmp_name'],$newimage);
    }else{
        $newimage =$oldimage;
    }
    $query = "UPDATE users SET user_email='$uemail',u_about='$uabout',ufname='$fullName',u_photo='$newimage',u_country='$ucountry',u_com='$ucom',com_reg='$ucom_regd_no',U_address='$uAddress',phone='$uPhone' WHERE user_name='$username'";
    $rq =mysqli_query($conn,$query);
    if ($rq) {
        header('location:profile.php');
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Profile updated sucessfully';
    }else{
    header('location:profile.php');
    $_SESSION['res_type'] ='danger';
    $_SESSION['response'] ='Something went wrong';
    }
    
}

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

if (isset($_GET['pro_id'])) {
    $id = checkInput($_GET['pro_id']);
    $row=getProductById($id);
    echo json_encode($row);
}
if (isset($_POST['sales_btn'])) {
    $customer_name = checkInput($_POST['cum_name']);
    $customer_fatherName = checkInput($_POST['cum_father']);
    $customer_phone = checkInput($_POST['cum_phone']);
    $cum_addr = checkInput($_POST['address']);
    $order_amount  = checkInput($_POST['sub_total']);
    $order_amount_paid = checkInput($_POST['paid-amount']);
    $grand_total = $order_amount - $order_amount_paid;
    $order_total_amount_due = $grand_total;
    
if (!empty($customer_name) || !empty($customer_fatherName) || !empty($cum_addr)) {
     $cumQuery ="INSERT INTO customers ( customer_name,father_name,phone_number, customer_address,order_amount, order_amount_paid, order_total_amount_due) VALUES (?,?,?,?,?,?,?)";
    $cumStmt = $conn->prepare($cumQuery);
    $cumStmt->bind_param('sssssss',$customer_name,$customer_fatherName, $customer_phone,$cum_addr, $order_amount, $order_amount_paid, $order_total_amount_due);
    $cumStmt->execute();
    $cum_id = $conn->insert_id;
    if ($cum_id >0) {
    $product_names = $_POST['product_name'];
    $product_price = $_POST['product_qty'];
    $product_qty = $_POST['product_price'];
    $product_total = $_POST['product_total'];
    foreach ($product_names as $key => $pname) {
        $pname= $pname;
        $pprice =$product_price[$key];
        $pqty =$product_qty[$key];
        $ptotal =$product_total[$key];
        $pq = "INSERT INTO  sales(customer_id,product_id,sales_qty, sales_price,sales_total_amount) VALUES(?,?,?,?,?)";
        $pst= $conn->prepare($pq);
        $pst->bind_param('sssss',$cum_id,$pname,$pprice,$pqty,$ptotal);
        $pst->execute();
        header('location:sales-frm.php');
        $_SESSION['res_type'] ='success';
        $_SESSION['response'] ='Sales generate successfully';
    }
  }else{
    header('location:sales-frm.php');
    $_SESSION['res_type'] ='danger';
    $_SESSION['response'] ='Something went wrong';
    }    
}else{
     header('location:sales-frm.php');
    $_SESSION['res_type'] ='danger';
    $_SESSION['response'] ='PLease enter input fields';
}

}