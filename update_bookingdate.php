<?php
require 'config.php';
$id=$_POST['id'];
$new_date=$_POST['new_date'];
$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM bookings WHERE id='$id'"));
 $date_in=$get['date_in'];
 $new_days=(strtotime($new_date)-strtotime($date_in))/86400;
 $date_out=date("Y-m-d",strtotime($new_date));

 $update=mysqli_query($con,"UPDATE bookings SET date_out='$date_out',no_of_nights='$new_days' WHERE id='$id'");
 if ($update) {
 	header("Location:check_rooms.php?msg=Date Has been Adjusted");
 }else{
 	header("Location:check_rooms.php?err=Date Couldnt be been Adjusted ".mysqli_error($con)."");
 }
