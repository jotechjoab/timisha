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
$grp_id=$_POST['grp_id'];
$total=$_POST['bill'];
$cash=$_POST['tendered'];
$change=$_POST['balance'];
$paymt_mode=$_POST['method'];
$identifier=$_POST['identifier'];
$trans_date=date("Y-m-d",strtotime($_POST['trans_date']));
$get_client=mysqli_query($con,"SELECT * FROM orders WHERE details_grp_id='$grp_id'");
$cl=mysqli_fetch_array($get_client);

	//$items=$request->input("batch");
$created_at=date('Y-m-d h:m:s');
$unit_of_measure='';
$details_grp_id="i".date("Ymd-h:i:s");
$trans_code="t".date("Ymd-h:i:s");
$description="Transation for order ".$grp_id;
$number=$cl['client'];
$place=$cl['location'];
    
$balance_due=$total-$cash;
$payment_status='';
if ($total<=$cash) {
$payment_status="Full";
$item_id="";
}else{
	$payment_status="partial";

}

	$get_items=mysqli_query($con,"SELECT * FROM order_details WHERE details_grp_id='$grp_id'");

	while($items=mysqli_fetch_array($get_items)) {
		$qty_bought=$items['qty'];
        $rate=$items['rate'];
        $item_id=$items['item_id'];	
if ($items['dept']==1) {
	$get_batch=mysqli_query($con,"SELECT s.batch_no,s.qty_in_stock,s.qty_sold,s.item_code FROM menu_items i, stocks s WHERE s.item_code=i.item_code AND i.id='$item_id' order by s.qty_in_stock DESC");
	$bat=mysqli_fetch_array($get_batch);
	 $ba=$bat['batch_no'];
	$code=$item_id;
	 $UOM=mysqli_query($con,"SELECT * FROM products where item_code='$code'");
	 $measure=mysqli_fetch_array($UOM);
	$unit_of_measure=$measure['unit_of_measure'];
 	if($qty_bought<=$bat['qty_in_stock']){
 		$oldStock=$bat['qty_in_stock'];
 		$oldSold=$bat['qty_sold'];
 		$newSold=$oldSold+$qty_bought;
 		$newStock=$oldStock-$qty_bought;

 $UpdateStock=mysqli_query($con,"UPDATE stocks set qty_in_stock='$newStock',qty_sold='$newSold' WHERE batch_no='$ba'");
}else{
	header("Location:myorders.php?err=The Available Stock for ".$item." is less than the equired ");
}

 	}else{
	$ba="No Batch";
	$code=$item_id;
	$unit_of_measure="Package";
}
		
	 
		 
 
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
	$update_orders=mysqli_query($con,"UPDATE orders SET post_status=1 WHERE details_grp_id='$grp_id'");
	if ($update_orders) {

		header("Location:doc.php?msg=Transaction Successiful&trans_code=".$trans_code."&grp_id=".$details_grp_id."&place=".$place."");
		}else{

			header("Location:myorders.php?err=Transation Not Successiful ".mysqli_error($con));
		}	
	}else{
 	echo mysqli_error($con);
 }	
 }

	}else{
		echo mysqli_error($con);
	}
	
	