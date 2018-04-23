<?php
require 'config.php';
$info=array();
session_start();
$info=$_SESSION['t_admin'];
$pay_stat=$_POST['payment_status'];
$app_stat=$_POST['approval_status'];
$po_no=$_POST['code'];
$id=$info['id'];

$sql="UPDATE po set payment_status='$pay_stat', approval_status='$app_stat', approved_by='$id' WHERE details_grp_id='$po_no'";
$update=mysqli_query($con,$sql);
if ($update) {
	header("Location:admin_po.php?msg=PO Has Been Approved");
}else{
	header("Location:admin_po.php?err=PO Couldnt Be Approved ".mysqli_error($con)."");
}