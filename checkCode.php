<?php
require 'config.php';
$id=$_POST['id'];
$matches="";
$new_code="";
$sql="SELECT item_code FROM products WHERE item_code LIKE '$id%' ORDER BY item_code DESC LIMIT 1";
$query=mysqli_query($con,$sql);
if (mysqli_num_rows($query)>0) {
	$row=mysqli_fetch_array($query);
	$last=$row['item_code'];
$last=substr($last, 3);
$last=$last+1;
preg_match_all('/(\d)|(\w)/', $id, $matches);

$numbers = implode($matches[1]);
$letters = implode($matches[2]);
$letters=$letters."-";
$new_code=$letters."".$last;
$new = array('new_code' =>$new_code);
	echo json_encode($new);
}else{
	$new_code=$id."001";

	$new = array('new_code' =>$new_code);
	echo json_encode($new);
}
