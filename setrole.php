<?php
require 'config.php';
$creator=$_POST['creator'];
$role=$_POST['role'];
$userid=$_POST['rid'];
$query=mysqli_query($con,"UPDATE users set profile_id='$role',status=1 WHERE id='$userid'");
if ($query) {
	header("Location:users.php?msg=Role Has been Assigned");

}else{
	header("Location:users.php?err=Role couldnt be been Assigned");
}