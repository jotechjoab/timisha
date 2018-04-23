<?php
require 'config.php';
date_default_timezone_set("Africa/Kampala");
$username=mysqli_real_escape_string($con,$_POST['username']);
 $password=mysqli_real_escape_string($con,$_POST['password']);
$last_login=date("Y-m-d h:m:s");

$sql="SELECT * FROM users WHERE (username='$username' AND password='$password') AND status=1";
$login_query=mysqli_query($con,$sql);
if (mysqli_num_rows($login_query)>0) {
	$row=mysqli_fetch_array($login_query);
	$id=$row['id'];
	mysqli_query($con,"UPDATE users set lastlogin_date='$last_login' WHERE id='$id'");
	session_start();
	$_SESSION['t_admin']=$row;
	$priv_id=$row['profile_id'];
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

if(in_array('bar',$paths,true)){  
	$home="order.php";
	header("Location:order.php");
}
if(in_array('kitchen',$paths,true)){  
	$home="view_kitorders.php";
	header("Location:view_kitorders.php");
}
if(in_array('all_routes',$paths,true)){  
	$home="home.php";
	header("Location:home.php");
}
if(in_array('rooms',$paths,true)){  
	$home="check_rooms.php";
	header("Location:check_rooms.php");
}
if(in_array('store',$paths,true)){  
	$home="view_po.php";
	header("Location:view_po.php");
}



}else{
	header("Location:index.php?err=Wrong Username Or Password");
}

