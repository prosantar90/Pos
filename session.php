<?php 
if (! file_exists(require 'config/config.php')) {
    require 'config/config.php';
}

if (isset($_SESSION['username'])) {
$user= $_SESSION['username'];
$stmt = $conn->prepare('SELECT * FROM users WHERE user_name=?');
$stmt->bind_param('s', $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);
$user_name=$row['user_name'];
$fullName = $row['ufname'];
$uphoto = $row['u_photo'];
$urole = $row['user_role'];
$comName =$row['u_com'];
$comRegd_no =$row['com_reg'];
$ucountry =$row['u_country'];
$uAddress =$row['U_address'];
$uPhone =$row['phone'];
$uemail =$row['user_email'];
$uabout =$row['u_about'];
}