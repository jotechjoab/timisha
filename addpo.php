<?php
session_start();
$info = array();
$info=$_SESSION['t_admin'];
$id=$ifo['id'];
require 'config.php';
$q=$_GET['code'];
$sql="INSERT INTO temp_po(pdt_code,session) VALUES ('$q','$id')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:po.php?msg=Item Added");
}else{
	header("Location:po.php?err=Item Added Not ".mysqli_error($con)."");
}