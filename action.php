<?php
if (! session_start()) {
    session_start();
}
include 'config/config.php';
require_once 'functions.php';
require_once 'src/includes.php';
/**
 * login using Ajax 
 * @package 
 * Best Post software
 */
if (isset($_POST['action']) && $_POST['action'] == 'login') {
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
    $uFullname = checkInput($_POST['ufname']);
    $uname = checkInput($_POST['uname']);
    $uemail = checkInput($_POST['uemail']);
    $upass = checkInput(sha1($_POST['upass']));
    $ucpass = checkInput(sha1($_POST['ucpass']));
    $utype = checkInput($_POST['utype']);
    $uphoto = $_FILES['uphoto']['name'];
    $upupload = 'uploads/' . $uphoto;

    if ($ucpass != $upass) {
        echo 'Password did not match';
        exit;
    }

    $q = "SELECT user_name, user_email FROM users WHERE user_name=? OR user_email=?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("ss", $uname, $uemail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($existing_user, $existing_email);
        $stmt->fetch();
        $_SESSION['res_type'] = "danger";
        $_SESSION['response'] = ($existing_user == $uname) ? "Username not available" : "Email not available";
        header("location:user_frm.php");
    } else {
        $sql = "INSERT INTO users(user_name, ufname, user_pass, user_email, user_role, u_photo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $uname, $uFullname, $upass, $uemail, $utype, $upupload);
        $run = $stmt->execute();
        move_uploaded_file($_FILES['uphoto']['tmp_name'], $upupload);

        if ($run) {
            $_SESSION['res_type'] = "success";
            $_SESSION['response'] = "User added successfully";
            header("location:user_frm.php");
        } else {
            echo 'Something went wrong: ' . $conn->error;
        }
    }
}



// Update Product 
require_once 'includes/users/functions.php';
require_once 'includes/supplier/functions.php';
include 'includes/products/functions.php';
include 'includes/category/functions.php';
include 'includes/brand/functions.php';
include 'includes/unit/functions.php';
include 'includes/users/functions.php';
include 'includes/customers/functions.php';
require_once 'includes/purchase/functions.php';
require_once 'includes/salesman/action.php';
require_once 'includes/sales/action.php';
require_once 'includes/home/action.php';

//  Sales Functions;
