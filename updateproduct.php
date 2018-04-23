<?php
require 'config.php';
date_default_timezone_set("Africa/Kampala");
$id=$_POST['pid'];
$name=$_POST['pname'];
$description=$_POST['description'];
$size=$_POST['size'];
$uom=$_POST['uom'];
$min_threshold=$_POST['min_threshold'];
$updated_by=$_POST['creator'];
$updated_at=date("Y-m-d h:m:s");

$sql="UPDATE products set name='$name',description='$description',size='$size',unit_of_measure='$uom',min_threshold='$min_threshold',updated_at='$updated_at',updated_by='$updated_by' WHERE id='$id'";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:products.php?msg=Product Updated");
}else{
	header("Location:products.php?err=Product Not Updated");
}