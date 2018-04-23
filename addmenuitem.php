<?php
require 'config.php';
$name=$_POST['name'];
$description=$_POST['description'];
$price=$_POST['price'];
$menu_id=$_POST['menu_id'];
$item_code=$_POST['item_code'];
$dept=$_POST['dept'];

$sql="INSERT INTO menu_items (item_code,name,description,price,menu_id,dept) VALUES ('$item_code','$name','$description','$price','$menu_id','$dept')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:menu.php?msg=Menu Item Has been Added");
}else{
	header("Location:menu.php?err=Couldn't Add Menu Item ".mysqli_error($con)."");
}