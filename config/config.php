<?php 
$host = 'localhost';
$user ='root';
$pass = '';
$db   = 'bank';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    echo 'Connecton fail';
    exit;
}


?>