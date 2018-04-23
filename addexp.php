<?php
require 'config.php';
$amount=$_POST['amount'];
$date=date("Y-m-d",strtotime($_POST['date_xp']));
$exp=$_POST['exp'];
$created_by=$_POST['creator'];

$chek=mysqli_query($con,"SELECT * FROM expenditures WHERE exp_date='$date'");
if (mysqli_num_rows($chek)>0) {
$update=mysqli_query($con,"UPDATE expenditures SET $exp = '$amount'  WHERE exp_date='$date'");
if ($update) {
header("Location:expenditures.php?msg=Expenditures Updates for Date ".$date."");
		}else{
			header("Location:expenditures.php?err=Error ". mysqli_error($con)."");
		}	
}else{
$inser=mysqli_query($con,"INSERT INTO expenditures ($exp,exp_date) VALUES('$amount','$date')");
if ($inser) {
	header("Location:expenditures.php?msg=Expenditures Added for  ".$date."");
		}else{
			header("Location:expenditures.php?err=Error ". mysqli_error($con)."");
		}	
}