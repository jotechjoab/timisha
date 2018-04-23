<?php
$host="localhost";
$db_uname="root";
$db_password="root";
$db="timisha";
$con=mysqli_connect($host,$db_uname,$db_password,$db) or die("Could Not Connect To Database");
if (!$con) {
	header("index.php?err=System Could not Connect to Database");
}