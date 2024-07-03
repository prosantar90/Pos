<?php
if (isset($_POST['save_unit'])) {
    $catName = checkInput($_POST['unit_name']);
    $st= '1';
    $q = "INSERT INTO units(unit_name, unit_status) VALUES(?,?)";
    $stmt= $conn->prepare($q);
    $stmt->bind_param('si',$catName, $st);
    $stmt->execute();
    header('location:unit-frm.php');
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Succefully Inserted';
}

    $u_id = '';
    $uName= '';
    $uUpdate = false;
if (isset($_GET['u_view'])) {
    $id = checkInput($_GET['u_view']);
    $uq = "SELECT * FROM units WHERE unit_id=?";
    $us= $conn->prepare($uq);
    $us->bind_param('i', $id);
    $us->execute();
    $ur= $us->get_result();
    $u= $ur->fetch_array(MYSQLI_ASSOC);
    $u_id = $u['unit_id'];
    $uName= $u['unit_name'];
    $uUpdate = true;
}
if(isset($_POST['u_update'])){
    $id = checkInput($_POST['u_id']);
    $uName = checkInput($_POST['unit_name']);
    $uq = "UPDATE units SET unit_name=? WHERE unit_id=?";
    $us = $conn->prepare($uq);
    $us->bind_param('si', $uName, $id);
    $us->execute();
    header('location:unit-frm.php?u_view='.$id);
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Unit updated successfully'   ;
}

if (isset($_GET['u_delete'])) {
    $id = checkInput($_GET['u_delete']);
    $ps = "DELETE FROM units WHERE units.unit_id= ?";
    $dp=$conn->prepare($ps);
    $dp->bind_param('i',$id);
    $dp->execute();
    header('location:units.php');
     $_SESSION['response'] = 'Product deleted Successfully';
    $_SESSION['res_type'] = 'danger'; 
}