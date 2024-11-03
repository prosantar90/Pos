<?php
session_start();
include '../../functions.php';
include '../../session.php';

$json_data = array();
$sql = "SELECT * FROM customers";

// Handle search functionality
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = checkInput($_POST['search']['value']);
    $sql .= " WHERE customer_name LIKE '%" . $search_value . "%' 
              OR phone_number LIKE '%" . $search_value . "%'";
}

// Handle ordering
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column'];  // DataTables sends column index
    $order_dir = $_POST['order'][0]['dir'];  // asc or desc

    // Map column index to actual column names
    $column_names = array('cum_id', 'customer_name', 'father_name', 'customer_address', 'phone_number', 'order_amount', 'order_total_amount_due', 'price');
    $column_name = $column_names[$column_index];
    $sql .= " ORDER BY " . $column_name . " " . $order_dir;
} else {
    $sql .= " ORDER BY cum_id DESC";
}

// Handle pagination (limit and offset)
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Get total records without filters
$totalRecordsSql = "SELECT count(*) as total FROM customers";
$totalRecordsRes = getData($totalRecordsSql);
$totalRecords = $totalRecordsRes[0]['total'] ?? 0;  // Default to 0 if not found

// Get filtered data
$rows = getData($sql);
$data = array();

foreach ($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['cum_id'];
    $sub_array[] = '<a href="javascript:void(0);" id="customer_view"  data-id="'.$row['cum_id'].'" data-toggle="modal" data-target="#cust_view_ajax">'.$row['customer_name'].'</a>';
    $sub_array[] = $row['father_name'];
    $sub_array[] = $row['customer_address'];
    $sub_array[] = $row['phone_number'];
    $sub_array[] = $row['order_amount'];
    $sub_array[] = $row['order_total_amount_due'];

    // Conditional rendering based on user role
    if ($urole == 'admin') {
    $sub_array[] = '
        <a href="customers-frm.php?cum_id=' . $row['cum_id'] . '" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
        <a href="javascript:void(0);" id="customer_view" class="badge badge-primary p-2" data-id="' . $row['cum_id'] . '" data-toggle="modal" data-target="#cust_view_ajax"><i class="ti-eye"></i></a>
        <a href="' . createSaltedUrl($row['cum_id'],'customer_transaction') . '" target="_blank" class="badge badge-primary p-2"><i class="ti-wallet"></i></a>
        <a href="javascript:void(0)" id="delete_customer" data-id="' . $row['cum_id'] . '" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
} else {
    $sub_array[] = '
        <a href="customers-frm.php?cum_id=' . $row['cum_id'] . '" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
        <a href="javascript:void(0);" id="customer_view" class="badge badge-primary p-2" data-id="' . $row['cum_id'] . '" data-toggle="modal" data-target="#cust_view_ajax"><i class="ti-eye"></i></a>
    ';
}

    $data[] = $sub_array;
}

// Prepare the final JSON response
$json_data = array(
    "draw"            => intval($_POST['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data
);

echo json_encode($json_data);
?>
