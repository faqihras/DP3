<?php
$ip_server='localhost';
$user_server='optima';
$pass_server="optima1234";
$db_server='klinik';

$con = mysqli_connect($ip_server,$user_server,$pass_server,$db_server) or die("gagal konek ke database pusat");



?>