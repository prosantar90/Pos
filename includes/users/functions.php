<?php 
$user = new Users($conn);

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


    $username = '';
    $userFullName = '';
    $userEmail = '';
    $userRole= '';
    $userPhoto = '';
    $users = false;

if (isset($_GET['user_id'])) {
    $uid = checkInput($_GET['user_id']);
    $runUid = $user->getUserById($uid);
    $username = $runUid['user_name'];
    $userFullName = $runUid['ufname'];
    $userEmail = $runUid['user_email'];
    $userRole= $runUid['user_role'];
    $userPhoto = $runUid['u_photo'];
    
    $users = true;
}

if(isset($_POST['user_delete'])){
    $r = $user->deleteUser(checkInput($_POST['user_delete']));
    if($r){
        echo 'ok';
    }else{
        echo 'Semething Went Wrong';
    }
}