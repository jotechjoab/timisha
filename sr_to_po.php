<?php

require 'config.php';
date_default_timezone_set("Africa/Kampala");
$sr=$_GET['sr'];
$value=$_GET['item_code'];
$supplier=$_GET['supplier'];
$grp_id="po_".date("Ymdhms");
$id=$_GET['id'];
$created_at=date("Y-m-d h:m:s");
$total="";
$amount="";




$qty=$_GET['qty'];
$uom=$_GET['uom'];
//$name=$_GET['name'.$value];
$rate=$_GET['rate'];
$description="";
$discount=0;
$amount=$rate*$qty;
$inserOk=0;

$sql_details="INSERT INTO po_details(details_grp_id,pdt_code,description,unit_of_measure,quantity,rate,discount,created_at,created_by) VALUES ('$grp_id','$value','$description','$uom','$qty','$rate','$discount','$created_at','$id')";
$query_detail=mysqli_query($con,$sql_details);

if($query_detail)
 {
	$total+=$amount;
	$inserOk=1;
}else{
	header("Location:po.php?err=Couldnt Add PO ".$grp_id." ".mysqli_error($con)."");
	$inserOk=0;
}



//echo $inserOk;
$sql="INSERT INTO po(details_grp_id,supplier_id,created_at,created_by,amount,payment_status,approval_status) VALUES('$grp_id','$supplier','$created_at','$id','$total','None','Pending')";
$query=mysqli_query($con,$sql);
if ($query) {

	$update_sr=mysqli_query($con,"UPDATE sr_details SET status=1 WHERE pdt_code='$value' AND details_grp_id='$sr'" );
if ($update_sr) {	
header("Location:view_po.php");
}
}else{
	header("Location:po.php?err=Couldn't Generate PO ".mysqli_query($con)."");
}
