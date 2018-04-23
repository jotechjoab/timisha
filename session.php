<?php
session_start();
$info = array();
$info=$_SESSION['t_admin'];
$home="";
if (count($info)>0) {
include 'config.php';
$priv_id=$info['profile_id'];
$get_priv=mysqli_query($con,"SELECT * FROM privilleges WHERE profile_id='$priv_id'");
$privs=mysqli_fetch_array($get_priv);

foreach (array_keys($privs,0) as $key) {
		unset($privs[$key]);
	}

	unset($privs['id']);
	unset($privs['created_at']);
	unset($privs['updated_at']);
	$privs=array_keys($privs);
	$paths=$privs;


}else{
	header("Location:index.php?err=Please Login First");
}

