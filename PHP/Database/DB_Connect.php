<?php 
$sever ='localhost';
$user = 'root';
$pass ='';
$db_name ='dacs2';
$con = new mysqli($sever,$user,$pass,$db_name);

if($con){
    mysqli_query($con,"SET NAMES 'utf8'"); 
}
else{
   echo("Kết nối thất bại");
}
?>