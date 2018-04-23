<?php
require 'config.php';
$id=$_POST['q'];
$sql="DELETE FROM temp_order WHERE session_id='$id'";
$mysqli_query=mysqli_query($con,$sql);
if ($mysqli_query) {
	echo '<tr><td colspan="4"><div class="alert alert-warning"> Order has been Cancled</div></td></tr>';
}else{
	echo '<div class="alert alert-danger"> '.mysqli_error($con).'</div>';
}