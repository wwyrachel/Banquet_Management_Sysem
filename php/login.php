<?php
	session_start();
	include 'config.php';
	$error='';
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//$conn = mysqli_connect("localhost","root","Hk34217787");
	//$db = mysqli_select_db($conn,"rabbittank");
	
	$sql="SELECT * FROM admin WHERE username = '$username' and password = '$password'";
				
	$result=$conn->query($sql);
	
	if($result->num_rows>0){
		$row= $result->fetch_assoc();
		$_SESSION['userID'] = $row['id'];
		$_SESSION['username'] = $username;
			  
		header("Location: index_logged_in.php");
	}else{
		echo "<script type='text/javascript'>alert('Wrong Account Name or Wrong Password, Please try again.');history.go(-1);</script>";
		
		
	}
	mysqli_close($conn);
?>