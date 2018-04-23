<?php
require 'config.php';
$id=$_POST['q'];

	$del_item=mysqli_query($con,"DELETE FROM menu_items WHERE id='$id'");

	if ($del_item) {echo "Success!!!!\n Item Has been  Deleted ";
	}else{
		echo "ERROR!!!!\n Couln't Delete item ".mysqli_error($con);
	}