<?php
require 'config.php';
$q=$_POST['q'];
$sql=mysqli_query($con,"SELECT * FROM bookings WHERE id='$q'");
$row=mysqli_fetch_array($sql);
$room=$row['room_no'];
mysqli_query($con,"UPDATE rooms set occupation_status=0,book_status=0 WHERE room_no='$room'");
mysqli_query($con,"UPDATE bookings set checkin_status='OUT' WHERE id='$q'");