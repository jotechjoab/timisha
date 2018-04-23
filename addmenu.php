<?php
require 'config.php';
$name=$_POST['name'];

$sql="INSERT INTO menu (name) VALUES ('$name')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:menu.php?msg=Menu Has been Added");
}else{
	header("Location:menu.php?err=Couldn't Add Menu ".mysqli_error($con)."");
}