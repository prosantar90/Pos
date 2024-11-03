<?php
session_start();
include '../../functions.php';
include '../../session.php';
$json_data= array();
$sql = "SELECT * FROM salesman ";

if(isset($_POST['search']['value'])){
    $search_value = checkInput($_POST['search']['value']);
    $sql .= 
    'WHERE salesman_name LIKE "%'. $search_value.'%"  OR 
    salesman_phone LIKE "%'. $search_value.'%" OR
    salesman_acc LIKE "%'. $search_value.'%" 
    ';
}
if(isset($_POST['order']))
{
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
    $sql .= " ORDER BY ID desc";
}
 

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT  ".$start.", ".$length;
}


$totalRecordsSql = "SELECT count(*) as total FROM salesman ";
$res = getData($totalRecordsSql);
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}

$rows = getData($sql);
$data = array();
foreach($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['ID'];
    $sub_array[] = '<a href="javascript:void(0);" id="man_view-btn" class="" data-id="'.$row['ID'].'" data-toggle="modal" data-target=".bd-example-modal-view">'.$row['salesman_name'].'</a>';
    $sub_array[] = '<img class="img-thumbnail" width="100" src="'.$row['salesman_img'].'">';
    $sub_array[] = $row['salesman_f_name'];
    $sub_array[] = $row['salesman_address'];
    $sub_array[] = $row['salesman_phone'];
    $sub_array[] = $row['balance'];
    // $sub_array[] = $row['salesman_bank'];

    // Conditional rendering based on user role
    if ($urole == 'admin') {
        $sub_array[] = '
            <a href="salesman_frm.php?man_edit='.$row['ID'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
            <a href="javascript:void(0);" id="man_view-btn" class="badge badge-primary p-2" data-id="'.$row['ID'].'" data-toggle="modal" data-target=".bd-example-modal-view"><i class="ti-eye"></i></a>
            <a href="'. createSaltedUrl($row['ID'],'salesman_transaction').'" target="_blank" class="badge badge-primary p-2"><i class="ti-wallet"></i></a>
            <a href="javascript:void(0)" data-id="'.$row['ID'].'"  id="man_delete" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '
            <a href="javascript:void(0);" id="man_view-btn" class="badge badge-primary p-2" data-id="'.$row['ID'].'" data-toggle="modal" data-target=".bd-example-modal-view"><i class="ti-eye"></i></a>';
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