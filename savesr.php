<?php

require 'config.php';
date_default_timezone_set("Africa/Kampala");
$codes = array();
$codes=$_POST['item_code'];
//$supplier=$_POST['supplier'];
$grp_id="sr_".date("Ymdhms");
$id=$_POST['id'];
$dept=$_POST['dept'];
$created_at=date("Y-m-d h:m:s");
$total="";
$amount="";



foreach ($codes as $key => $value) {
$qty=$_POST['qty_'.$value];
$uom=$_POST['uom_'.$value];
$name=$_POST['name_'.$value];
$rate=$_POST['rate_'.$value];
$description="";
$discount=0;
$amount=$rate*$qty;
$inserOk=0;

$sql_details="INSERT INTO sr_details(details_grp_id,pdt_code,description,unit_of_measure,quantity,rate,created_at,created_by) VALUES ('$grp_id','$value','$description','$uom','$qty','$rate','$created_at','$id')";
$query_detail=mysqli_query($con,$sql_details);

if($query_detail)
 {
	$total+=$amount;
	echo $inserOk=1;
}else{
echo $inserOk=0;
echo mysqli_error($con);
	break;
	header("Location:stock_request.php?err=Couldnt Add  ".$grp_id." ".mysqli_error($con)."");

}

}

echo $inserOk;
$sql="INSERT INTO sr(details_grp_id,created_at,created_by,amount,approval_status,dept) VALUES('$grp_id','$created_at','$id','$total','Pending','$dept')";
$query=mysqli_query($con,$sql);
if ($query) {
	mysqli_query($con,"DELETE FROM temp_sr WHERE session='$id'");
header("Location:view_sr.php?dept=".$dept."");
}else{
	header("Location:stock_request.php?err=Couldn't Generate PO ".mysqli_error($con)."&dept=".$dept."");
}
