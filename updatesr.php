<?php
require 'config.php';
session_start();
$ifo=array();
$dept=$_POST['dept'];
$info=$_SESSION['t_admin'];
$updated_by=$info['id'];
$id = array();
$id=$_POST['id'];
$code=$_POST['code'];
$total="";
foreach ($id as $key => $value) {
$qty=$_POST['qty_'.$value];
$rate=$_POST['rate_'.$value];
$amount=$qty*$rate;
$total+=$amount;
$update="UPDATE sr_details set quantity='$qty', rate='$rate' ,updated_by='$updated_by' WHERE id='$value'";
$u_query=mysqli_query($con,$update);
if ($u_query) {

	}else{
	header("Location:view_sr.php?err=Couldnt Update Stock request Details ".mysqli_error($con)."&dept=$dept");
	break;	
	}	
}

$update_po="UPDATE sr set amount='$total',updated_by='$updated_by' WHERE details_grp_id='$code'";
$query=mysqli_query($con,$update_po);
if ($query) {
header("Location:view_sr.php?msg=Details Have Been Updated&dept=$dept");
}else{
 header("Location:view_sr.php?err=Could Updated PO details".mysqli_error($con)."&dept=$dept");
}

