<?php
session_start();
$info = array();
$info=$_SESSION['t_admin'];
if (count($info)>0) {
	# code...
}else{
header("Location:index.php?err=Please login First ");
}
$id=$info['id'];
require 'config.php';
$q=$_GET['code'];
$dept=$_GET['dept'];
$sql="INSERT INTO temp_sr(pdt_code,session) VALUES ('$q','$id')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:stock_request.php?msg=Item Added&dept=".$dept."");
}else{
	header("Location:stock_request.php?err=Item Added Not ".mysqli_error($con)."&dept=".$dept."");
}