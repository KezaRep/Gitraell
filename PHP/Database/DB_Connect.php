<?php 
$server ='localhost';
$user = 'root';
$pass ='';
$db_name ='gitraell';

$con = new mysqli($server, $user, $pass, $db_name);

// Kiểm tra kết nối
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}

// Thiết lập UTF-8
$con->set_charset("utf8");
?>
