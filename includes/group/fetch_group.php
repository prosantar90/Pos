<?php
session_start();
include '../../functions.php';
include '../../session.php';

$json_data = array();
$sql = "SELECT * FROM samiti_group";

// Handle search functionality
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = checkInput($_POST['search']['value']);
    $sql .= " WHERE group_name LIKE '%" . $search_value . "%' 
              OR phone_no LIKE '%" . $search_value . "%'";
}

// Handle ordering
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column'];  // DataTables sends column index
    $order_dir = $_POST['order'][0]['dir'];  // asc or desc

    // Map column index to actual column names
    $column_names = array('id', 'group_name', 'g_adhar','group_addrss', 'phone_no','created_at');
    $column_name = $column_names[$column_index];
    $sql .= " ORDER BY " . $column_name . " " . $order_dir;
} else {
    $sql .= " ORDER BY id DESC";
}

// Handle pagination (limit and offset)
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Get total records without filters
$totalRecordsSql = "SELECT count(*) as total FROM samiti_group";
$totalRecordsRes = getData($totalRecordsSql);
$totalRecords = $totalRecordsRes[0]['total'] ?? 0;  // Default to 0 if not found

// Get filtered data
$rows = getData($sql);
$data = array();

foreach ($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = '<a href="javascript:void(0);" id="group_view"  data-id="'.$row['id'].'" data-toggle="modal" data-target="#group_view_ajax">'.$row['group_name'].'</a>';
    $sub_array[] = $row['g_adhar'];
    $sub_array[] = $row['group_addrss'];
    $sub_array[] = $row['phone_no'];
    $sub_array[] = $row['created_at'];

    // Conditional rendering based on user role
    if ($urole == 'admin') {
    $sub_array[] = '
        <a href="group-frm.php?id=' . $row['id'] . '" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
        <a href="javascript:void(0);" id="group_view" class="badge badge-primary p-2" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#group_view_ajax"><i class="ti-eye"></i></a>
        <a href="javascript:void(0)" id="delete_customer" data-id="' . $row['id'] . '" class="badge badge-danger p-2"><i class="ti-trash"></i></a>

        <a href="group_view.php?group_id='.$row['id'].'" data-id="' . $row['id'] . '" class="badge badge-success p-2"><i class="ti-new-window"></i></a>';
} else {
    $sub_array[] = '
        <a href="group-frm.php?id=' . $row['id'] . '" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
        <a href="javascript:void(0);" id="group_view" class="badge badge-primary p-2" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#group_view_ajax"><i class="ti-eye"></i></a>
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
