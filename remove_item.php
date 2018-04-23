<?php
require 'config.php';
$q=$_POST['q'];
$sql="DELETE FROM temp_order WHERE id ='$q'";
mysqli_query($con,$sql);
