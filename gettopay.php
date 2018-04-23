<?php
require 'config.php';
$q=$_POST['q'];
	echo '<SELECT name="cust" id="cust" class="form-control">';
if ($q=='Rooms') {
$sql="SELECT id,name FROM accounts WHERE category_id=5 ";
$mysql=mysqli_query($con,$sql);
if (mysqli_num_rows($mysql)>0) {

	while ($row=mysqli_fetch_array($mysql)) {
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}

}else{
	echo '<option disabled="">No Record '.mysqli_error($con).'</option>';
	}
}elseif ($q=='Clients') {
$sql="SELECT id,name FROM accounts WHERE category_id=1 AND id!=1";
$mysql=mysqli_query($con,$sql);
if (mysqli_num_rows($mysql)>0) {
	while ($row=mysqli_fetch_array($mysql)) {
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
}else{
	echo '<option disabled="">No Record '.mysqli_error($con).'</option>';
	}
}

	echo '</SELECT>';

