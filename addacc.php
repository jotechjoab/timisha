<?php
require 'config.php';
date_default_timezone_set("Africa/Kampala");
$name=$_POST['name'];
$description=$_POST['description'];
$cat_id=$_POST['cat_id'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$created_by=$_POST['creator'];
$created_at=date("Y-m-d h:m:s");

$sql="INSERT INTO accounts (name,category_id,description,email,phone,address,created_by,created_at) VALUES ('$name','$cat_id','$description','$email','$phone','$address','$created_by','$created_at')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:accounts.php?msg=Account added Successifully");
}else{
	header("location:accounts.php?err=Account couldn't be added ".mysqli_error($con)."");
}
