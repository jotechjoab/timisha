<?php
require 'config.php';
$id=$_POST['id'];

$sql="SELECT * FROM rooms WHERE id='$id'";
$query=mysqli_query($con,$sql);
$info = array();
$row=mysqli_fetch_array($query);
$info=$row;
echo json_encode($info);
