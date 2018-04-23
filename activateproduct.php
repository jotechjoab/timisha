<?php
require 'config.php';
$q=$_POST['q'];
$sql="UPDATE products SET status='active' WHERE id='$q'";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:products.php?mgs=Item Activated");
 }else{
 	header("Location:products.php?err=Item Not Activated ".mysqli_error($con)."");
 } 
