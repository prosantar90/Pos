<?php

$columns = ['id', 'user_name', 'ufname', 'user_email', 'user_role', 'user_photo'];
$sql = "SELECT * FROM users WHERE 1=1";

// Search functionality
if (!empty($_POST['search']['value'])) {
    $search_value = "%" . $_POST['search']['value'] . "%";
    $sql .= " AND (id LIKE ? OR user_name LIKE ? OR user_email LIKE ?)";
}

$orderColumn = 0; // Default column
$orderDir = 'asc'; // Default direction

if (isset($_POST['order']) && isset($_POST['order'][0])) {
    $orderColumn = $_POST['order'][0]['column'];
    $orderDir = $_POST['order'][0]['dir'];
}

$limit = $_POST['length'] ?? 10; // Default limit
$offset = $_POST['start'] ?? 0; // Default offset

$sql .= " ORDER BY " . $columns[$orderColumn] . " " . $orderDir . " LIMIT ? OFFSET ?";

// Prepare statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error in SQL query: ' . $conn->error);
}

if (!empty($_POST['search']['value'])) {
    $stmt->bind_param('sssss', $search_value, $search_value, $search_value, $limit, $offset);
} else {
    $stmt->bind_param('ii', $limit, $offset);
}

$stmt->execute();
$result = $stmt->get_result();
$data = array();

while ($row = $result->fetch_assoc()) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['user_name'];
    $sub_array[] = $row['ufname'];
    $sub_array[] = $row['user_email'];
    $sub_array[] = $row['user_role'];

    // Check if user_photo exists and is not null, otherwise set a default image or message
    $user_photo = !empty($row['user_photo']) ? $row['user_photo'] : 'default.jpg';
    $sub_array[] = '<img src="' . $user_photo . '" alt="User Photo" class="rounded" width="50">';

    // Conditional action buttons based on user role
    if ($row['user_role'] == 'admin') {
        $sub_array[] = '<a href="m-form.php?r_view=' . $row['id'] . '" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
                        <a href="#" class="badge badge-primary p-2"><i class="ti-eye"></i></a>
                        <a href="javascript:void(0)" id="m_delete" class="badge badge-danger p-2" data-id="' . $row['id'] . '"><i class="ti-trash"></i></a>';
    } else {
        $sub_array[] = '<a href="m-recieve.php?r_view=' . $row['id'] . '" target="_blank" class="badge badge-primary p-2">View</a>';
    }

    $data[] = $sub_array;
}

// Get total records
$total_sql = "SELECT COUNT(*) AS total FROM users";
$total_res = $conn->query($total_sql);
$total_row = $total_res->fetch_assoc();
$totalRecords = $total_row['total'];

$json_data = array(
    "draw" => intval($_POST['draw'] ?? 0),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data" => $data
);

// echo json_encode($json_data);
?>
