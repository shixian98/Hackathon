<?php
error_reporting(0);
session_start();
include 'config.php';
$conn = mysql_pconnect($shserver,$shuser,$shpwd);
mysql_select_db($shbilling, $conn);
mysql_query("set names utf8");
if (!$conn){printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());}
?>