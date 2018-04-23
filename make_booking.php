<?php
require 'config.php';
date_default_timezone_set("Africa/Kampala");
$info=array();
session_start();
$info=$_SESSION['t_admin'];
if (count($info)>0) {
$id=$info['id'];

}else{
	header("Location:index.php?err=Please login your session expired");
}
//guest details
$created_at=date("Y-m-d h:m:s");
$name=$_POST['name'];
$id_no=$_POST['id_no'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$destination=$_POST['destination'];
$occupation=$_POST['occupation'];
$no_guest=$_POST['no_of_guests'];
$Ok=0;
//booking details
$room_no=$_POST['room_no'];
$date_in=date("Y-m-d",strtotime($_POST['date1']));
$date_out=date("Y-m-d",strtotime($_POST['date2']));
$guest_id="";
$book_date=date("Y-m-d",strtotime($_POST['booking_date']));

$check_guest=mysqli_query($con,"SELECT * FROM guests WHERE phone='$phone' OR email='$email'");	
if (mysqli_num_rows($check_guest)>0) {
	$guest=mysqli_fetch_array($check_guest);
	$guest_id=$guest['id'];
	$Ok=1;
	}else{
$sql_g="INSERT INTO guests(name,id_no,phone,email,address,destination,occupation,created_by) VALUES ('$name','$id_no','$phone','$email','$address','$destination','$occupation','$id')";
$query_g=mysqli_query($con,$sql_g);
if ($query_g) {
	$get_guest=mysqli_query($con,"SELECT * FROM guests WHERE phone='$phone'");
	$guest=mysqli_fetch_array($get_guest);
	$guest_id=$guest['id'];
	$Ok=1;
}else{
	$OK=0;
	header("Location:book_room.php?err=".mysqli_error($con)."");
}

}	
if ($Ok==1) {
	makebooking($con,$room_no,$date_in,$date_out,$guest_id,$no_guest,$book_date,$id);
}else{
	header("Location:book_room.php?err=".mysqli_error($con)."");
}


function makebooking($con,$room_no,$date_in,$date_out,$guest_id,$no_guest,$book_date,$id){
	$no_of_nights=(strtotime($date_out)-strtotime($date_in))/86400;


	if (isset($_POST['checkin'])) {
$checkin=$_POST['checkin'];
$sql="INSERT INTO bookings(room_no,date_in,date_out,guest_id,no_of_guests,booking_date,created_by,no_of_nights,checkin_status) VALUES('$room_no','$date_in','$date_out','$guest_id','$no_guest','$book_date','$id','$no_of_nights','IN')";
$query=mysqli_query($con,$sql);
$update_room=mysqli_query($con,"UPDATE rooms SET book_status=1, occupation_status=1 WHERE room_no='$room_no'");
header("Location:check_rooms.php?msg=Room has been booked and Checked In");
}else{
$sql="INSERT INTO bookings(room_no,date_in,date_out,guest_id,no_of_guests,booking_date,created_by,no_of_nights,checkin_status) VALUES('$room_no','$date_in','$date_out','$guest_id','$no_guest','$book_date','$id','$no_of_nights','Not In')";
$query=mysqli_query($con,$sql);	
$update_room=mysqli_query($con,"UPDATE rooms SET book_status=1 WHERE room_no='$room_no'");	
header("Location:check_rooms.php?msg=Room has been booked");
}

if (!$query) {
	header("Location:check_rooms.php?err=Operation Failed ".mysqli_error($con));
}


}

