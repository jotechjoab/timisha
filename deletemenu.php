<?php
require 'config.php';
$id=$_POST['q'];
$del_menu=mysqli_query($con,"DELETE FROM menu WHERE id='$id'");

if ($del_menu) {
	$del_item=mysqli_query($con,"DELETE FROM menu_items WHERE menu_id='$id'");

	if ($del_item) {echo "Success!!!!\n Menu Has been  Deleted ";
	}else{
		echo "ERROR!!!!\n Couln't Delete item ".mysqli_error($con);
	}

}else{
	echo "ERROR!!!!\n Couln't Delete item ".mysqli_error($con);
}