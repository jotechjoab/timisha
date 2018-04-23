<?php
require 'config.php';
$name=$_POST['name'];
$sql="INSERT INTO profiles(name) VALUES ('$name')";
$query=mysqli_query($con,$sql);
if ($query) {
$get_prof=mysqli_query($con,"SELECT * FROM profiles ORDER BY created_at DESC limit 1");
$prof=mysqli_fetch_array($get_prof);
$id=$prof['id'];	
mysqli_query($con,"INSERT INTO privilleges(profile_id) VALUES ('$id')");
	header("Location:permisions.php?msg=Profile Added");
}else{
	header("Location:permisions.php?err=Profile Not Added".mysqli_error($con)."");
}
