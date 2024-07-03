<?php
if (isset($_POST['save_brand'])) {
    $catName = checkInput($_POST['brand_name']);
    $st= '1';
    $q = "INSERT INTO brand(brand_name, brand_status) VALUES(?,?)";
    $stmt= $conn->prepare($q);
    $stmt->bind_param('si',$catName, $st);
    $stmt->execute();
    header('location:brand-frm.php');
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Succefully Inserted';
}
    $br_id = '';
    $brName= '';
    $bUpdate = false;
if (isset($_GET['b_view'])) {
    $id = checkInput($_GET['b_view']);
    $bq = "SELECT * FROM brand WHERE b_id=?";
    $ps= $conn->prepare($bq);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $r= $pr->fetch_array(MYSQLI_ASSOC);
    $br_id = $r['b_id'];
    $brName= $r['brand_name'];
    $bUpdate = true;
}
if(isset($_POST['up_brand'])){
    $id = checkInput($_POST['b_id']);
    $brName = checkInput($_POST['brand_name']);
    $bu = "UPDATE brand SET brand_name=? WHERE b_id=?";
    $bs = $conn->prepare($bu);
    $bs->bind_param('si', $brName, $id);
    $bs->execute();
    header('location:brand-frm.php?b_view='.$id);
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Brand updated successfully'   ;
}
if (isset($_GET['b_delete'])) {
    $id = checkInput($_GET['b_delete']);
    $ps = "DELETE FROM brand WHERE brand.b_id= ?";
    $dp=$conn->prepare($ps);
    $dp->bind_param('i',$id);
    $dp->execute();
    header('location:brands.php');
     $_SESSION['response'] = 'Product deleted Successfully';
    $_SESSION['res_type'] = 'danger'; 
}