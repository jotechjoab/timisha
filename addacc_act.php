<?php
require 'config.php';
$name=$_POST['name'];
$description=$_POST['description'];
$sql="INSERT INTO account_categories (name,description) VALUES ('$name','$description')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:acc_categories.php?msg=Category added Successifully");
}else{
	header("location:acc_categories.php?err=Category couldn't be added ".mysqli_error($con)."");
}
