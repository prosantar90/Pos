<?php 
if (! file_exists(require 'config/config.php')) {
    require 'config/config.php';
}

// if (isset($_SESSION['username'])) {
// $user= $_SESSION['username'];
// $stmt = $conn->prepare('SELECT * FROM users WHERE user_name=?');
// $stmt->bind_param('s', $user);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_array(MYSQLI_ASSOC);
// $user_name=$row['user_name'];
// $fullName = $row['ufname'];
// $uphoto = $row['u_photo'];
// $urole = $row['user_role'];
// $comName =$row['u_com'];
// $comRegd_no =$row['com_reg'];
// $ucountry =$row['u_country'];
// $uAddress =$row['U_address'];
// $uPhone =$row['phone'];
// $uemail =$row['user_email'];
// $uabout =$row['u_about'];
// }

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];

    // Prepare and execute the query to get logged-in user info
    $stmt = $conn->prepare('SELECT * FROM users WHERE user_name = ?');
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);

    // User information
    $user_name = $row['user_name'];
    $fullName = $row['ufname'];
    $uphoto = $row['u_photo'];
    $urole = $row['user_role'];
    $uabout = $row['u_about'];
    $uemail = $row['user_email'];
    $uPhone = $row['phone'];

    // Query to get admin's company information for display
    $adminRole = 'admin';
    $stmt = $conn->prepare('SELECT u_com, com_reg, U_address, u_country FROM users WHERE user_role = ? ORDER BY id ASC LIMIT 1');
    $stmt->bind_param('s', $adminRole);
    $stmt->execute();
    $adminResult = $stmt->get_result();
    $adminRow = $adminResult->fetch_array(MYSQLI_ASSOC);

    // Display company info if available
    $comName = $adminRow['u_com'] ?? 'Company information not available';
    $comRegd_no = $adminRow['com_reg'] ?? 'N/A';
    $uAddress = $adminRow['U_address'] ?? 'N/A';
    $ucountry = $adminRow['u_country'] ?? 'N/A';


}
