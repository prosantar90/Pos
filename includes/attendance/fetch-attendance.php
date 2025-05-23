<?php
session_start();
include '../../functions.php';
include '../../session.php';
$json_data = array();
$sql = "SELECT group_attendance.id as atID, samiti_group.id as gID, samiti_group.group_name, group_attendance.attendance_date,samiti_group.g_adhar,group_attendance.status FROM group_attendance LEFT JOIN samiti_group ON group_attendance.group_id = samiti_group.id ";

// Handle search functionality
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = checkInput($_POST['search']['value']);
    $sql .= " WHERE group_name LIKE '%" . $search_value . "%' 
             OR g_adhar LIKE '%" . $search_value . "%'
             OR  group_attendance.attendance_date LIKE '%" . $search_value . "%'
              OR phone_no LIKE '%" . $search_value . "%'";
}

// Handle ordering
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column'];  // DataTables sends column index
    $order_dir = $_POST['order'][0]['dir'];  // asc or desc

    // Map column index to actual column names
    $column_names = array('group_attendance.id', '.samiti_group.group_name','group_attendance.attendance_date');
    $column_name = $column_names[$column_index];
    $sql .= " ORDER BY " . $column_name . " " . $order_dir;
} else {
    $sql .= " ORDER BY group_attendance.id DESC";
}

// Handle pagination (limit and offset)
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Get total records without filters
$totalRecordsSql = "SELECT count(*) as total FROM group_attendance";
$totalRecordsRes = getData($totalRecordsSql);
$totalRecords = $totalRecordsRes[0]['total'] ?? 0;  // Default to 0 if not found

// Get filtered data
$rows = getData($sql);
$data = array();
$num = count($rows);
foreach ($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = $num--;
    $sub_array[] = '<a href="javascript:void(0);" id="group_view"  data-id="'.$row['gID'].'" data-toggle="modal" data-target="#group_view_ajax">'.$row['group_name'].'</a>';
    $sub_array[] = $row['attendance_date'];
    $sub_array[] = $row['g_adhar'];
    $sub_array[] = $row['status'];
    // Conditional rendering based on user role
    if ($urole == 'admin') {
    $sub_array[] = '
        <a href="javascript:void(0)" id="delete_attendance" data-id="' . $row['atID'] . '" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
} else {
    $sub_array[] = '
        <a href="javascript:void(0);" id="group_view" class="badge badge-primary p-2" data-id="' . $row['gID'] . '" data-toggle="modal" data-target="#group_view_ajax"><i class="ti-eye"></i></a>
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

