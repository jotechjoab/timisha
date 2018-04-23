<?php
require 'config.php';
$com=$_POST['com'];
$id=$_POST['coid'];
$get_details=mysqli_query($con,"SELECT * FROM order_details WHERE id='$id'");
$detail=mysqli_fetch_array($get_details);
$update=mysqli_query($con,"UPDATE order_details SET comment='$com' WHERE id ='$id'");
$grp_id=$detail['details_grp_id'];

//echo $total;
if ($update) {
	
		header("location:order_details.php?od=$grp_id&msg=Order Has Been Updated");
	}else{
	header("location:order_details.php?od=$grp_id&err=".mysqli_error($con)."");	
	}
