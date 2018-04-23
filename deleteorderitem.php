<?php
require 'config.php';
$oid=$_POST['q'];
$get_details=mysqli_query($con,"SELECT * FROM order_details WHERE id='$oid'");
$detail=mysqli_fetch_array($get_details);
$update=mysqli_query($con,"DELETE from order_details WHERE id ='$oid'");
$grp_id=$detail['details_grp_id'];
$total='';
$am=mysqli_query($con,"SELECT * FROM order_details WHERE details_grp_id='$grp_id'");

while($row=mysqli_fetch_array($am)){
	$amount=$row['qty']*$row['rate'];

	$total+=$amount;

}
//echo $total;
if (mysqli_error($con)=='') {
	$update_order=mysqli_query($con,"UPDATE orders set amount='$total' WHERE details_grp_id='$grp_id'");
	if ($update_order) {
		header("location:order_details.php?od=$grp_id&msg=Order Has Been Updated");
	}else{
	header("location:order_details.php?od=$grp_id&err=".mysqli_error($con)."");	
	}
}