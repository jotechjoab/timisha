<?php
require 'config.php';
$loc=$_POST['location'];
$tbl=$_POST['tbl'];
$sql="INSERT INTO places(location,tbl) VALUES ('$loc','$tbl')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:places.php?msg=Place Added");
}else{
	header("Location:places.php?err=Place Not Added".mysqli_error($con)."");
}
