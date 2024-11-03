<?php
header('Content-Type: application/json');
session_start();
include '../../functions.php';
include '../../session.php';

$saleRange = isset($_GET['saleRange']) ? $_GET['saleRange'] : 'all';

$query = "SELECT COUNT(*) as 'total_sales', SUM(sales_qty) as qty, SUM(sales_total_amount) as sales_amount, DATE_FORMAT(created_at,'%d-%b-%y') as sDate FROM sales";

if ($saleRange === '1MS') {
    $query .= " WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
} elseif ($saleRange === '6MS') {
    $query .= " WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)";
} elseif ($saleRange === '1YS') {
    $query .= " WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
} elseif ($saleRange === 'YTDS') {
    $query .= " WHERE created_at >= DATE_FORMAT(NOW() ,'%Y-01-01')"; // Start of the current year
}

// Group by date
$query .= " GROUP BY sales_invoice";

$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$data = array();
foreach ($results as $row) {
    $data[] = $row;
}
echo json_encode($data);
