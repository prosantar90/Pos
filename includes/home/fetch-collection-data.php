<?php
session_start();
include '../../functions.php';
include '../../session.php';
$json_data= array();
// $sql = "SELECT * FROM customers WHERE promis_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 10 DAY)";
$sql = "SELECT * FROM customers ";

if(isset($_POST['search']['value'])){
    $search_value = checkInput($_POST['search']['value']);
    $sql .= " WHERE customer_name LIKE '%" . $search_value . "%' 
              OR phone_number LIKE '%" . $search_value . "%'";
}
if(isset($_POST['order']))
{
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
    $sql .= "ORDER BY cum_id DESC";
}
 

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT  ".$start.", ".$length;
}


$totalRecordsSql = "SELECT count(*) as total FROM products";
$res = getData($totalRecordsSql);
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}

$rows = getData($sql);
$data = array();
foreach($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['product_id'];
    $sub_array[] = '<img src="'.$row['p_image'].'" alt="'.$row['p_image'].'" class="rounded" width="50">';
    $sub_array[] = $row['product_name'];
    $sub_array[] = $row['product_code'];
    $sub_array[] = $row['category_name'];
    $sub_array[] = $row['brand_name'];
    $sub_array[] = $row['unit_name'];
    $sub_array[] = $row['quantity'];
    $sub_array[] = $row['mrp_price'];

    // Conditional rendering based on user role
    if ($urole == 'admin') {
        $sub_array[] = '
            <a href="product-frm.php?p_view='.$row['product_id'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
            <a href="javascript:void(0);" id="pro_view" class="badge badge-primary p-2" data-id="'.$row['product_id'].'" data-toggle="modal" data-target="#pr_view"><i class="ti-eye"></i></a>
            <a href="action.php?p_delete='.$row['product_id'].'" onclick="return delete_alert();" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '
            <a href="product-frm.php?p_view='.$row['product_id'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
            <a href="javascript:void(0);" id="pro_view" class="badge badge-primary p-2" data-id="'.$row['product_id'].'" data-toggle="modal" data-target="#pr_view"><i class="ti-eye"></i></a>';
    }

    $data[] = $sub_array;
}

$json_data = array(
 "draw"            => intval( $_POST['draw'] ),   
 "recordsTotal"    => intval($totalRecords ),  
 "recordsFiltered" => intval($totalRecords),
 "data"            => $data   // total data array
 );
echo  json_encode($json_data);