<?php
session_start();
include '../../functions.php';
include '../../session.php';
$json_data= array();
$sql = "SELECT * FROM purchase 
LEFT JOIN products ON purchase.product_id = products.product_id 
LEFT JOIN supplier ON purchase.supplier_id= supplier.sup_ID
LEFT JOIN units ON products.sales_unit = units.unit_id
";

if(isset($_POST['search']['value'])){
    $search_value = checkInput($_POST['search']['value']);
    $sql .= 
    'WHERE product_code LIKE "%'. $search_value.'%"  OR 
    product_name LIKE "%'. $search_value.'%" 
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


$totalRecordsSql = "SELECT count(*) as total FROM purchase ";
$res = getData($totalRecordsSql);
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}

$rows = getData($sql);
$data = array();
foreach($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['ID'];
    $sub_array[] = '  <a href="javascript:void(0);" id="purchase_views" class="" data-id="'.$row['ID'].'" data-toggle="modal" data-target="#pr_view">'.$row['product_name'].'</a>';
    $sub_array[] = $row['product_code'];
    $sub_array[] = $row['product_qty'];
    $sub_array[] = $row['unit_name'];
    $sub_array[] = $row['supplier_name'];
    $sub_array[] = inDateTime($row['purchase_at']);

    // Conditional rendering based on user role
    if ($urole == 'admin') {
        $sub_array[] = '
            <a href="purchase-frm.php?purchase_view='.$row['ID'].'" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
            <a href="javascript:void(0);" id="purchase_views" class="badge badge-primary p-2" data-id="'.$row['ID'].'" data-toggle="modal" data-target="#pr_view"><i class="ti-eye"></i></a>
            <a href="javascript:void(0) data-id="'.$row['ID'].'"  id="purchase_delete" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '
            <a href="action.php?p_view='.$row['ID'].'" class="badge badge-primary p-2">View</a>';
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