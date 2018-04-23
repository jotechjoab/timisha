<?php
require 'config.php';
$id=$_POST['q'];
$sql=mysqli_query($con,"SELECT * FROM guests WHERE name LIKE '%$id%'");
if (mysqli_num_rows($sql)>0) {
	echo '<option value=""> Please Select Guest </option>';

while($qry=mysqli_fetch_array($sql)){
	echo '<option value="'.$qry['id'].'">'.$qry['name'].' '.$qry['phone'].'</option>';
}

}else{
echo '<option value="" style="color:red;"> No Guest Found! Please Enter Details</option>';
}
