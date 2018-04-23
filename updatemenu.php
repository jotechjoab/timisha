<?php
require 'config.php';
$name=$_POST['name'];
$id=$_POST['menu_id'];
$update=mysqli_query($con,"UPDATE menu SET name='$name' WHERE id='$id'");
if ($update) {
	header("Location:menu.php?msg=Bingo! Menu was Updated ");
}else{
	header("Location:menu.php?err=Error! Menu was not  Updated ");
}