<?php
require 'config.php';
$user=$_POST['user'];
$cust=$_POST['cust'];
$place=$_POST['places'];
$id=array();
$grp_id="o_".date("ymdhms");
$id=$_POST['ids'];
$Ok="";
$total="";

foreach ($id as $key => $value) {
$qty=$_POST['qty_'.$value];
$price=$_POST['price_'.$value];	
$amount=$qty*$price;
$dept=mysqli_fetch_array(mysqli_query($con,"SELECT dept FROM menu_items WHERE id='$value'"));
$dept_id=$dept['dept'];
$sql="INSERT INTO order_details (details_grp_id,item_id,rate,dept,qty) VALUES ('$grp_id','$value','$price','$dept_id','$qty')";
$query=mysqli_query($con,$sql);
if ($query) {
	$Ok=1;
}else{
	$Ok=0;
	break;
	header("Location:oder.php?err=Could Place Order".mysqli_error($con)."");
}
$total+=$amount;
}
if ($Ok==1) {
	$o_sql="INSERT INTO orders (details_grp_id,amount,created_by,client,location) VALUES ('$grp_id','$total','$user','$cust','$place')";
	$o_query=mysqli_query($con,$o_sql);
	if ($o_query) {
	mysqli_query($con,"DELETE FROM temp_order WHERE session_id='$user'");
	header("Location:order.php?msg=Order Has been Placed");
	}else{
		header("Location:order.php?err=Order Couldn't Placed".mysqli_error($con)."");
	}
}else{
	header("Location:order.php?err=Order Couldn't Placed".mysqli_error($con)."");
}