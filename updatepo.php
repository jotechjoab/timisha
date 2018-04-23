<?php
require 'config.php';
session_start();
$ifo=array();
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
$update="UPDATE po_details set quantity='$qty', rate='$rate' ,updated_by='$updated_by' WHERE id='$value'";
$u_query=mysqli_query($con,$update);
if ($u_query) {

	}else{
	header("Location:view_po.php?err=Couldnt Update Purchase Order Details ".mysqli_error($con)."");
	break;	
	}	
}

$update_po="UPDATE po set amount='$total',updated_by='$updated_by' WHERE details_grp_id='$code'";
$query=mysqli_query($con,$update_po);
if ($query) {
header("Location:view_po.php?msg=Details Have Been Updated");
}else{
 header("Location:view_po.php?err=Could Updated PO details ".mysqli_error($con)."");
}

