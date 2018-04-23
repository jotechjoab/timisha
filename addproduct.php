<?php
require 'config.php';
$item_code=$_POST['item_code'];
$name=$_POST['pname'];
$supplier=$_POST['supplier'];
$dept=$_POST['dept'];
$description=$_POST['description'];
$size=$_POST['size'];
$uom=$_POST['uom'];
$min_threshold=$_POST['min_threshold'];
$created_at=date("Y-m-d h:m:s");
$created_by=$_POST['creator'];

$sql="INSERT INTO products (item_code,name,description,supplier_id,size,unit_of_measure,dept,min_threshold,created_at) VALUES ('$item_code','$name','$description','$supplier','$size','$uom','$dept','$min_threshold','$created_at')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:products.php?msg=Product Was Added");
}else{
	header("Location:products.php?err=Product Was Not Added".mysqli_error($con)."");
}