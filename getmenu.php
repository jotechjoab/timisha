<?php
require 'config.php';
$id=$_POST['q'];
$qry=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM menu WHERE id='$id'"));
echo json_encode($qry);