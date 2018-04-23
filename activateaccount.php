<?php
require 'config.php';
$id=$_POST['q'];
$act=mysqli_query($con,"UPDATE accounts SET status=1 WHERE id='$id'");
if ($act) {
echo 'done';
}else{
	echo mysqli_error($con);
}