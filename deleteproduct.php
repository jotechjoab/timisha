<?php
require 'config.php';
$q=$_POST['q'];
$sql="DELETE FROM products WHERE id='$q'";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:products.php?mgs=Item Deleted");
 }else{
 	header("Location:products.php?err=Item Not Deleted ".mysqli_error($con)."");
 } 
