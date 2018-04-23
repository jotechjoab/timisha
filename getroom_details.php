<?php 
require 'config.php';
$room=$_POST['q'];
$room_sql="SELECT r.room_no,room_name,t.name,t.amount FROM rooms r,room_types t WHERE (t.id=r.room_type AND r.book_status=0) AND (r.occupation_status=0 AND r.room_no='$room')";
$getrooms=mysqli_query($con,$room_sql);
if(mysqli_num_rows($getrooms)>0){
	$rooms=array();
$rooms=mysqli_fetch_array($getrooms);
echo json_encode($rooms);

}

?>