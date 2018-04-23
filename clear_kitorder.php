<?php
require 'config.php';
$id=$_GET['id'];
$kit=mysqli_query($con,"UPDATE kitchen_orders SET status=1 WHERE order_id='$id'");
if ($kit) {
$oders=mysqli_query($con,"UPDATE order_details SET status=1 WHERE id='$id'");
if ($oders) {
header("Location:view_kitorders.php?msg=Thanks For The Good Work Bro Order has Been Cleared");
	}else{
header("Location:view_kitorders.php?err=Thanks For The Good Work Bro But Order Couldn't Cleared ".mysqli_error($con));		
	}	
}else{
header("Location:view_kitorders.php?err=Thanks For The Good Work Bro But Order Couldn't Cleared ".mysqli_error($con));
}
