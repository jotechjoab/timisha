<?php
require 'config.php';
session_start();
$info=array();
$info=$_SESSION['t_admin'];
if (count($info)>0) {
$id=$info['id'];
}else{
	header("Location:index.php?err=Please Login your Session Expired");
}
$order=$_POST['order_id'];
$order_detail=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM order_details WHERE id='$order'"));

$sql="INSERT INTO kitchen_orders (order_id,created_by) VALUES ('$order','$id')";
$query=mysqli_query($con,$sql);

if ($query) {
	mysqli_query($con,"UPDATE order_details SET send_status=1 WHERE id='$order'");
	header("Location:order_details.php?msg=Order Sent&od=".$order_detail['details_grp_id']."");
}else{
	header("location:order_details.php?err=Order Couldnt be sent  ".mysqli_error($con)."&od=".$order_detail['details_grp_id']."");
}


