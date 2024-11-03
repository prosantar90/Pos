<?php

/**
 * Add Product Category 
 * @package 
 * Best Pos Software
 */
if (isset($_POST['add_cat'])) {
    $catName = checkInput($_POST['cat_name']);
    $st= '1';
    $q = "INSERT INTO categories(category_name, cat_status) VALUES(?,?)";
    $stmt= $conn->prepare($q);
    $stmt->bind_param('si',$catName, $st);
    $stmt->execute();
    header('location:category_frm.php');
    $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Succefully Inserted';
}

/**
 * View Product Category 
 * @package 
 * Best Pos Software
 */
    $cat_id = '';
    $catName= '';
    $cUpdate = false;
if (isset($_GET['c_view'])) {
    $id = checkInput($_GET['c_view']);
    $cq = "SELECT * FROM categories WHERE cat_id=?";
   $ps= $conn->prepare($cq);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $r= $pr->fetch_array(MYSQLI_ASSOC);
    $cat_id = $r['cat_id'];
    $catName= $r['category_name'];
    $cUpdate = true;
}
/**
 * Update Product Category 
 * @package 
 * Best Pos Software
 */
if(isset($_POST['update_cat'])){
    $id = checkInput($_POST['ca_id']);
    $catName = checkInput($_POST['cat_name']);
    $cu = "UPDATE categories SET category_name=? WHERE cat_id=?";
    $cs = $conn->prepare($cu);
    $cs->bind_param('si', $catName, $id);
    $cs->execute();
    header('location:category_frm.php?c_view='.$id);
     $_SESSION['res_type'] ='success';
    $_SESSION['response'] ='Category updated successfully'   ;
}
/**
 * Delete Product Category 
 * @package 
 * Best Pos Software
 */
if (isset($_GET['c_delete'])) {
    $id = checkInput($_GET['c_delete']);
    $ps = "DELETE FROM categories WHERE categories.cat_id= ?";
    $dp=$conn->prepare($ps);
    $dp->bind_param('i',$id);
    $dp->execute();
    header('location:category.php');
    $_SESSION['response'] = 'Product deleted Successfully';
    $_SESSION['res_type'] = 'danger'; 
}

/**
 * Staus active and inactive Product Category 
 * @package 
 * Best Pos Software
 */
if (isset($_GET['cat_id'])) {
    $id = checkInput($_GET['cat_id']);
    $status = checkInput($_GET['status']);
    $bs = "UPDATE categories SET cat_status='$status' WHERE cat_id= '$id'";
    $rs = mysqli_query($conn,$bs);
    header('location:category.php');
}
