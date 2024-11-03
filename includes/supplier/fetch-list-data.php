<?php
session_start();
include '../../functions.php';
include '../../session.php';
$json_data= array();
$sql = "SELECT * FROM supplier ";

if(isset($_POST['search']['value'])){
    $search_value = checkInput($_POST['search']['value']);
    $sql .= 
    'WHERE sup_phone LIKE "%'. $search_value.'%"  OR 
    sup_ID LIKE "%'. $search_value.'%" OR
    supplier_name LIKE "%'. $search_value.'%" 
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
    $sql .= " ORDER BY sup_ID desc";
}
 

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT  ".$start.", ".$length;
}


$totalRecordsSql = "SELECT count(*) as total FROM supplier ";
$res = getData($totalRecordsSql);
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}

$rows = getData($sql);
$data = array();
foreach($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['sup_ID'];
    $sub_array[] = '<a href="javascript:void(0);" id="suppliers_views" class="" data-id="'.$row['sup_ID'].'" data-toggle="modal" data-target="#sup_view">'.$row['supplier_name'].'</a>';
    $sub_array[] = $row['sup_phone'];
    $sub_array[] = $row['sup_address'];
    $sub_array[] = $row['sup_total_amount'];
    $sub_array[] = $row['sup_ad_amount'];
    $sub_array[] = $row['sup_due_amount'];
    if ($row['status'] == '1'){
        $sub_array[]= '<a class="label label-success" href="action.php?sup_ID='. $row['sup_ID'].'&status=0">Active</a>';
    }else{
        $sub_array[]= '<a class="label label-danger" href="action.php?sup_ID='. $row['sup_ID'].'&status=1">Deactive</a>';
    }

    // Conditional rendering based on user role
    if ($urole == 'admin') {
        $sub_array[] = '
            <a href="suplier-frm.php?su_view='.$row['sup_ID'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
            <a href="'. createSaltedUrl($row['sup_ID'],'supplier_transaction').'" target="_blank" class="badge badge-primary p-2"><i class="ti-wallet"></i></a>
            <a href="javascript:void(0)" data-id="'.$row['sup_ID'].'"  id="supl_delete" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '
            <a href="suplier-frm.php?su_view='.$row['sup_ID'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>';
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