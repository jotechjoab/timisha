<?php
require 'config.php';
	date_default_timezone_set('Africa/Kampala');
	$pending=$_POST['pending'];
	$tcode=$_POST['trans_code'];
	$group_id=$_POST['grp_id'];
	$cash_tendered=$_POST['cash'];
	$number=$_POST['cust'];
	$change=$_POST['change'];
	$jno=$_POST['journal_id'];
	$uid=$_POST['user'];
	$newtc="t".date("Ymd-h:m:s");
	$created_at=date("Y-m-d h:m:s");
	$description="Payment for receipts ".$tcode;
	$newbal=0;
	$place="Payment For Unpaid";
	$check=$pending-$cash_tendered;
	if($check<=0){
		$newbal=0;
	}else {
		$newbal=$pending-$cash_tendered;
	}


$transactions=explode(',',$tcode);
$invoices=explode(',',$group_id);

$arraylength=count($transactions);
$num=count($transactions);

if($change>=0){

foreach ($invoices as $key => $value) {

$updateinvoice=mysqli_query($con,"UPDATE invoices set payment_status='Full',updated_by='$uid' where details_grp_id='$value'");
	}

$makeReciept=mysqli_query($con,"INSERT INTO receipts(trans_code,description,paymt_mode,cash_tendered,amount_paid,change_returned,balance_due,received_by,created_by,date_created) VALUES ('$newtc','$description','Cash','$cash_tendered','$pending','$change','$newbal','$number','$uid','$created_at')");

if ($makeReciept) {

	$makeTransaction=mysqli_query($con,"INSERT INTO transactions (created_at,created_by,trans_code,trans_type,description,account_dr,account_cr,status,journal_id) VALUES('$created_at','$uid','$newtc','inflow','$description','$number',4,'complete','$jno')");

	if ($makeTransaction) {
		
	header("Location:doc.php?msg=Transaction Successiful&trans_code=".$newtc."&grp_id=".$value."&place=".$place."");

	// 	$data['msg']="Process Success Balance Cleared";
	// return view('pages.paybal',$data);
	}else{
	header("Location:unpaid.php?err=Error! ".mysqli_error($con)."");
	}
}else{
	header("Location:unpaid.php?err=Error! ".mysqli_error($con)."");
}
}else{

$makeReciept=mysqli_query($con,"INSERT INTO receipts(trans_code,description,paymt_mode,cash_tendered,amount_paid,change_returned,balance_due,received_by,created_by,date_created) VALUES ('$newtc','$description','Cash','$cash_tendered','$pending','$change','$newbal','$number','$uid','$created_at')");

if ($makeReciept) {

	$makeTransaction=mysqli_query($con,"INSERT INTO transactions (created_at,created_by,trans_code,trans_type,description,account_dr,account_cr,status,journal_id) VALUES('$created_at','$uid','$newtc','inflow','$description','$number',4,'complete','$jno')");

	if ($makeTransaction) {


foreach ($invoices as $key => $value) {

$updateinvoice=mysqli_query($con,"UPDATE invoices set payment_status='partial',updated_by='$uid' where details_grp_id='$value'");

	}
		header("Location:doc.php?msg=Transaction Successiful&trans_code=".$newtc."&grp_id=".$value."&place=".$place."");
	}else{
		header("Location:unpaid.php?err=Error! ".mysqli_error($con)."");
}

}else{
header("Location:unpaid.php?err=Error! ".mysqli_error($con)."");
}

}