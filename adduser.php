<?php
include 'config.php';
date_default_timezone_set("Africa/Kampala");
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$oname=$_POST['oname'];
$creator=$_POST['creator'];
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$created_at=date("Y-m-d h:m:s");

$image_url="";
if(isset($_FILES['img_url'])){
      $errors= array();
      $file_name = $_FILES['img_url']['name'];
      $file_size =$_FILES['img_url']['size'];
      $file_tmp =$_FILES['img_url']['tmp_name'];
      $file_type=$_FILES['img_url']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['img_url']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
    $image_url="images/".$file_name;
      }else{
        header("Location:users.php?err=".$errors."");
      }
   }

$sql="INSERT INTO users (username,email,password,fname,lname,other_name,phone_no,avater_path,creator_id,created_at) VALUES ('$username','$email','$password','$fname','$lname','$oname','$phone','$image_url','$creator','$created_at')";

$query=mysqli_query($con,$sql);
if ($query) {
	header("Location:users.php?msg=User has Been Add");
}else{
	header("Location:users.php?err=Couldn't Add User ErrorCode TM001".mysqli_error($con)."");
}
