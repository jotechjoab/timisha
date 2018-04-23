<?php
require 'config.php';
$id=$_POST['id'];

$sql="DELETE FROM users WHERE id='$id'";
$query=mysqli_query($con,$sql);
if ($query) {
	$info = array('status' => 1);
	echo json_encode($info);
}else{
	$info = array('status' => 0);
	echo json_encode($info);
}
