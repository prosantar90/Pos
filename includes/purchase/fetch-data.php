<?php
header('Content-Type: application/json');
session_start();
include '../../functions.php';
include '../../session.php';

$range = isset($_GET['range']) ? $_GET['range'] : 'all';

$query = "SELECT COUNT(*) as 'items', product_qty as qty, SUM(products.mrp_price) as mrp, 
          DATE_FORMAT(purchase.purchase_at, '%d-%b-%y') as pdate 
          FROM purchase 
          LEFT JOIN products ON purchase.product_id = products.product_id";

if ($range === '1M') {
    $query .= " WHERE purchase.purchase_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
} elseif ($range === '6M') { 
    $query .= " WHERE purchase.purchase_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)";
} elseif ($range === '1Y') {  
    $query .= " WHERE purchase.purchase_at >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
} elseif ($range === 'YTD') {  
    $query .= " WHERE purchase.purchase_at >= DATE_FORMAT(NOW() ,'%Y-01-01')"; // Start of the current year
}

// Group by date
$query .= " GROUP BY DATE(purchase.purchase_at)";

$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$data = array();
foreach ($results as $row) {
    $data[] = $row;
}
echo json_encode($data);
