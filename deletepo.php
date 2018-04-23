<?php
require 'config.php';
$q=$_POST['q'];
$sql="DELETE FROM temp_po WHERE id='$q'";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:po.php?mgs=Item Deleted");
 }else{
 	header("Location:po.php?err=Item Not Deleted ".mysqli_error($con)."");
 } 
