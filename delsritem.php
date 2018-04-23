<?php
require 'config.php';
$id=$_POST['id'];
$grp_id=$_POST['grp_id'];
session_start();
$info = array();
$info =$_SESSION['t_admin'];

$del=mysqli_query($con,"DELETE FROM sr_details WHERE id='$id'");

if ($del) {
	$total="";
$sql=mysqli_query($con,"SELECT * FROM sr_details WHERE details_grp_id='$grp_id'");
if (mysqli_num_rows($sql)>0) {
	# code...

while ($row=mysqli_fetch_array($sql)) {
	$amount=$row['quantity']*$row['rate'];

	$total+=$amount;
}

mysqli_query($con,"UPDATE sr SET amount='$total' WHERE details_grp_id='$grp_id'");
}else{
mysqli_query($con,"DELETE FROM sr WHERE details_grp_id='$grp_id'");
}
}else{
	echo "Error While Deleting ". mysqli_error($con);
}
echo mysqli_error($con);