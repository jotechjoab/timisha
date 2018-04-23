<?php
require 'config.php';
$name=$_POST['name'];
$number=$_POST['number'];
$type=$_POST['type'];
$sql="INSERT INTO rooms (room_name,room_no,room_type) VALUES ('$name','$number','$type')";
$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:rooms.php?msg=Room added Successifully");
}else{
	header("location:rooms.php?err=Room couldn't be added ".mysqli_error($con)."");
}
