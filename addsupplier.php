<?php
require 'config.php';
date_default_timezone_set("Africa/Kampala");
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$created_at=date("Y-m-d h:m:s");
$sql="INSERT INTO suppliers(name,phone,email,address,created_at) VALUES ('$name','$phone','$email','$address','$created_at')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:suppliers.php?msg=Supplier Added");
}else{
	header("Location:suppliers.php?err=Supplier Not Added".mysqli_error($con)."");
}
