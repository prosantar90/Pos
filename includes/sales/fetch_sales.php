<?php
session_start();
include '../../functions.php';
include '../../session.php';

$json_data = array();
$sql = "SELECT sales.sales_invoice, sales.customer_id, customers.customer_name, SUM(sales.sales_qty) as qty, SUM(sales.sales_total_amount) as total, sales.created_at 
        FROM sales 
        LEFT JOIN customers ON sales.customer_id = customers.cum_id 
        GROUP BY sales.sales_invoice";

// Handle search functionality
if (isset($_POST['search']['value'])) {
    $search_value = checkInput($_POST['search']['value']);
    $sql .= " HAVING sales.sales_invoice LIKE '%" . $search_value . "%' 
              OR customers.customer_name LIKE '%" . $search_value . "%'";
}

// Handle ordering
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column'];  // DataTables sends column index
    $order_dir = $_POST['order'][0]['dir'];  // asc or desc

    // Map column index to actual column names
    $column_names = array('sales_invoice', 'customer_name', 'qty', 'total', 'created_at');
    $column_name = $column_names[$column_index];
    $sql .= " ORDER BY " . $column_name . " " . $order_dir;
} else {
    $sql .= " ORDER BY sales_invoice DESC";
}

// Handle pagination (limit and offset)
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Get total records
$totalRecordsSql = "SELECT COUNT(DISTINCT sales.sales_invoice) as total FROM sales";
$totalRecordsRes = getData($totalRecordsSql);
$totalRecords = $totalRecordsRes[0]['total'] ?? 0; 
// Get filtered data
$rows = getData($sql);
$data = array();
foreach ($rows as $key => $row) {
    $sub_array = array();
    $sub_array[] = '<a href="javascript:void(0);" id="sales_view"  data-id="'.$row['sales_invoice'].'" data-toggle="modal" data-target="#sale_view_ajax">'.sprintf('%04d', $row['sales_invoice']).'</a>';
    $sub_array[] = $row['customer_name'];
    $sub_array[] = $row['qty'];
    $sub_array[] = $row['total'];
    $sub_array[] = inDateTime($row['created_at']);

    // Conditional rendering based on user role
    if ($urole == 'admin') {
        $sub_array[] = '
            <a href="includes/invoices/sales-print.php?invoice=' . $row['sales_invoice'] . '" class="badge badge-primary p-2" target="_blank"><i class="ti-printer"></i></a>
            <a href="javascript:void(0);" class="badge badge-primary p-2" id="sales_view"  data-id="'.$row['sales_invoice'].'" data-toggle="modal" data-target="#sale_view_ajax"><i class="ti-eye"></i></a>
            <a href="javascript:void(0)" data-id="' . $row['sales_invoice'] . '" id="sales_delete" class="badge badge-danger p-2"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '
                   <a href="includes/invoices/sales-print.php?invoice=' . $row['sales_invoice'] . '" class="badge badge-primary p-2"><i class="ti-printer"></i></a>
                    <a href="javascript:void(0);" class="badge badge-primary p-2" id="sales_view"  data-id="'.$row['sales_invoice'].'" data-toggle="modal" data-target="#sale_view_ajax"><i class="ti-eye"></i></a>
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
