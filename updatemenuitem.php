<?php
require 'config.php';
$name=$_POST['name'];
$id=$_POST['id'];
$desc=$_POST['description'];
$price=$_POST['price'];
$update=mysqli_query($con,"UPDATE menu_items SET name='$name',description='$desc',price='$price' WHERE id='$id'");
if ($update) {
	header("Location:menu.php?msg=Bingo! Menu Item was Updated ");
}else{
	header("Location:menu.php?err=Error! Menu Item was not  Updated ");
}