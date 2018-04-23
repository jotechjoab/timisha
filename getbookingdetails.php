<?php
require 'config.php';
$q=$_POST['q'];
$ex_money=0;
$sql="SELECT b.id,b.room_no,b.no_of_nights,b.no_of_guests,t.amount FROM bookings b,room_types t, rooms r WHERE (r.room_type=t.id AND b.room_no=r.room_no) AND b.id='$q' ";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
if ($row['no_of_guests']>1) {
	$extra=$row['no_of_guests']-1;
	$ex_money=$extra*15000;
}
$amount=($row['amount']+$ex_money)*$row['no_of_nights'];

$values = array();
$values['amount']=$amount;
$values['room']=$row['room_no'];
$values['book_id']=$row['id'];
echo json_encode($values);
