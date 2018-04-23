<?php
require 'config.php';
$sr=$_POST['q'];
mysqli_query($con,"DELETE FROM sr WHERE details_grp_id='$sr'");
mysqli_query($con,"DELETE FROM sr_details WHERE details_grp_id='$sr'");
