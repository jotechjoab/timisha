<?php
require 'config.php';
$name=$_POST['name'];
$id=$_POST['rid'];
$room_no=$_POST['room_no'];
$update=mysqli_query($con,"UPDATE rooms SET room_name='$name',room_no='$room_no' WHERE id='$id'");
if ($update) {
	header("Location:rooms.php?msg=Bingo! Menu was Updated ");
}else{
	header("Location:rooms.php?err=Error! Menu was not  Updated ");
}