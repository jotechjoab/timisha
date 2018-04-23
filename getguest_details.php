<?php
require 'config.php';
$id=$_POST['q'];
$sql="SELECT * FROM guests WHERE id='$id'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
echo json_encode($row);