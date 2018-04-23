<?php
require 'config.php';
$name=$_POST['name'];
$sql="INSERT INTO departments(name) VALUES ('$name')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:dept.php?msg=Department Added");
}else{
	header("Location:dept.php?err=Department Not Added".mysqli_error($con)."");
}
