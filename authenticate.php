<?php
	include('db.php');
	session_start();

	$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);

	//select the user whose mobile and password is entered from database
	$sql="SELECT * FROM users WHERE mobile='$mobile' AND password='$password'";
	$result= mysqli_query($conn,$sql);

	//if number of row returned > 0, means user exists and user details are valid, so login else display error message
	if(mysqli_num_rows($result)>0)
	{
	  $_SESSION['login'] = 1; //set session variable 
	  echo "You are now Logged In";
	}
	else
	{
	  echo "Incorrect Mobile-no or Password";
	}
?>