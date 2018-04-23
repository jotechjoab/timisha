<?php
require 'config.php';
$id=$_POST['id'];
$field=$_POST['field'];
$query=mysqli_query($con,"UPDATE privilleges set $field=0 WHERE id='$id'");