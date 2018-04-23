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

$sql="INSERT INTO bar_orders (order_id,created_by) VALUES ('$order','$id')";
$query=mysqli_query($con,$sql);

if ($query) {
	mysqli_query($con,"UPDATE order_details SET send_status=1 WHERE id='$order'");
$kit=mysqli_query($con,"UPDATE bar_orders SET status=1 WHERE order_id='$order'");
if ($kit) {
$oders=mysqli_query($con,"UPDATE order_details SET status=1 WHERE id='$order'");
if ($oders) {
header("Location:order_details.php?msg=Order Sent&od=".$order_detail['details_grp_id']."");
	}else{
header("Location:order_details.php?msg=Order Sent&od=".$order_detail['details_grp_id']."");
	}	
}else{
header("Location:order_details.php?msg=Order Sent&od=".$order_detail['details_grp_id']."");
}

}else{
	header("location:order_details.php?err=Order Couldnt be sent&od=".$order_detail['details_grp_id']."");
}

