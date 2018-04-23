<?php
require 'config.php';
session_start();
$info=array();
$info=$_SESSION['t_admin'];
if (count($info)>0) {
	$transacted_by=$info['id'];
		$id=$info['id'];
}else{
 header("Location:index.php?err=Please Login Your Session Expired");
}
date_default_timezone_get("Africa/Kampala");
$grp_id=$_POST['room_no'];
$total=$_POST['bill'];
$book=$_POST['booking'];
$cash=$_POST['tendered'];
$change=$_POST['balance'];
$paymt_mode=$_POST['method'];
$identifier=$_POST['identifier'];
$trans_date=date("Y-m-d",strtotime($_POST['trans_date']));
	//$items=$request->input("batch");
$place="Room: ".$grp_id;
$created_at=date('Y-m-d h:m:s');
$unit_of_measure='';
$details_grp_id="i".date("Ymd-h:i:s");
$trans_code="t".date("Ymd-h:i:s");
$description="Transation for Booking ".$book." in room".$grp_id;
$ac=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM accounts WHERE name='$grp_id'"));
$number=$ac['id'];
    
$balance_due=$total-$cash;
$payment_status='';
if ($total<=$cash) {
$payment_status="Full";
$item_id="";
}else{
	$payment_status="partial";

}

	$get_items=mysqli_query($con,"SELECT b.id,b.room_no,b.no_of_nights,b.no_of_guests,t.amount FROM bookings b,room_types t, rooms r WHERE (r.room_type=t.id AND b.room_no=r.room_no) AND b.id='$book' ");

	while($items=mysqli_fetch_array($get_items)) {
		$qty_bought=$items['no_of_nights'];
        $rate=$items['amount'];
        $item_id="b_".$items['id'];	
	$ba="Rooms";
	$code=$item_id;
	$unit_of_measure="Nights";

		
   // $UOM=Product::selectRaw('unit_of_measure')->where('item_code','=',$code)->get()->toArray();
   // $unit_of_measure=$UOM[0]['unit_of_measure'];

   $inv_details=mysqli_query($con,"INSERT INTO invoice_details (details_grp_id,pdt_code,batch_no,description,unit_of_measure,quantity,rate,discount,created_by,created_at) VALUES ('$details_grp_id','$code','$ba','$description','$unit_of_measure','$qty_bought','$rate',0,'$id','$created_at')");

  

//    // echo $ChangeStock[0]['item_code'];
   }
   //echo mysqli_error($con);

	$insertJounal=mysqli_query($con,"INSERT INTO journals (created_at,posted_by,due_date,account_dr,account_cr,journal_type,journal_type_id,description) VALUES ('$created_at','$id','$created_at','$number',4,'invoice','$details_grp_id','$description')");

	if ($insertJounal) {

		$makeInvoice=mysqli_query($con,"INSERT INTO invoices (details_grp_id,description,payment_method,payment_identifier,payment_status,created_at,created_by,approval_status,approved_by) VALUES('$details_grp_id','$description','$paymt_mode','$identifier','$payment_status','$created_at','$id','Approved','$id')");

	}else{
		echo mysqli_error($con);
	}

	$makeReciept=mysqli_query($con,"INSERT INTO receipts(trans_code,description,paymt_mode,cash_tendered,amount_paid,change_returned,balance_due,received_by,created_by,date_created) VALUES('$trans_code','$description','$paymt_mode','$cash','$total','$change','$balance_due','$number','$id','$created_at')");


	if ($makeReciept) {
		$sql_j=mysqli_query($con,"SELECT * FROM journals WHERE journal_type_id='$details_grp_id'");
		$journalId=mysqli_fetch_array($sql_j);
		
	$jno = $journalId['id'];
	if ($jno!='') {

			$makeTransaction=mysqli_query($con,"INSERT INTO transactions (created_at,created_by,trans_code,trans_date,transacted_by,trans_type,description,account_dr,account_cr,status,journal_id) VALUES('$created_at','$id','$trans_code','$trans_date','$transacted_by','inflow','$description','$number',4,1,'$jno')");
if ($makeTransaction) {
	$update_orders=mysqli_query($con,"UPDATE bookings SET status=1 WHERE id='$book'");
	if ($update_orders) {

		header("Location:doc.php?msg=Transaction Successiful&trans_code=".$trans_code."&grp_id=".$details_grp_id."&place=".$place."");
		}else{

			header("Location:myorders.php?err=Transation Not Succesiful ".mysqli_error($con));
		}	
	}else{
 	echo mysqli_error($con);
 }	
 }

	}else{
		echo mysqli_error($con);
	}
	
	