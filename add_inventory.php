<?php
require 'config.php';
session_start();
$ifo=array();
$info=$_SESSION['t_admin'];
$created_by=$info['id'];
$purchased_by=$_POST['purchased_by'];
$date_purchased=date("Y-m-d h:m:s",strtotime($_POST['date_purchased']));
$codes=array();
$po=$_POST['po'];
$codes=$_POST['codes'];
foreach ($codes as $key => $value) {
	$batch_no=$value."_".date("ymdhms");
	$qty=$_POST['qty_'.$value];
	$sql="INSERT INTO inventories (batch_no,item_code,purchase_date,qty_purchased,qty_in_store,purchased_by,po_id,status,created_by) VALUES ('$batch_no','$value','$date_purchased','$qty','$qty','$purchased_by','$po','Ready','$created_by')";
	$query=mysqli_query($con,$sql);
	if ($query) {
		mysqli_query($con,"UPDATE po set status='Cleared' WHERE details_grp_id='$po'");
		header("Location:inventory.php?msg=New Items Have been Added here ");
	}else{
		header("Location:inventory.php?err=Error While Adding New Items Here ".mysqli_error($con)."");
	}
}
