<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Change User Info--Rabbit Banquet</title>

</head>

<body>

	
<?php
include 'config.php';
?>
				
<div class="wrapper row1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index_logged_in.php">RabbitBanquet</a></h1>
      <p>Assistance for Banquet Management.</p>
    </div>
	 <?php
	 session_start();
	if (isset($_SESSION['username'])){
		
		echo "<div style=\"float:right\"id=\"forgot\"> welcome!!   ".$_SESSION['username']."<a href=\"logout.php\"> logout</a></div>";
	}
	else
	{
		echo "<form action=\"login.php\" method=\"post\" id=\"login\">";
		echo "<input type=\"password\" placeholder=\"Password\" name=\"password\" />";
		echo "<input type=\"text\" placeholder=\"Username\" name=\"username\" />";
		echo "<div id=\"forgot\"><a href=\"register.php\">Register</a> or <a href=\"#\">Forgot Your Password?</a></div>";
		echo "<button type=\"submit\" id=\"btn\" value=\"Login\" class=\"button-sty\">Login</button>";
		echo "</form>";
	}
	?>
    
  </div>
</div>


<div class="menuBar">
<a href="view_all_banquet_admin.php">All Banquets</a> &middot;
<a href="create_banquet_admin.php">Create</a> &middot;
<a href="import_record_admin.php">Import</a> &middot;
<a href="search_banquet_admin.php">Search Banquet</a> &middot;
<a href="search_attendee_admin.php">Search Attendee</a> &middot;
<a href="locations_admin.php">Locations</a> &middot;
<a href="report_admin.php">Report</a> &middot;
<a href="setting_password_admin.php">Settings</a> 
</div>

<div class="whiteSpace">
</div>
<h1>Change User Information</h1>

<?php

if (isset($_POST["Update"])){
	require "config.php";
	//$username=$_POST["username"];
	$pass=$_POST["pass"];
	$pass1=$_POST["pass1"];
	$name= $_POST["name"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$emailnoti=$_POST["emailnoti"];
	

	if ((!empty($pass) || empty($pass1)) AND $pass != $pass1){
	echo "Password and Confirmed Password are not the same!!<br>";
	}
	else{
	if (empty($pass)|| empty($name)){
	echo "Password and Name are required!!";
	}

	else{
	$sql="UPDATE admin SET name='$_POST[name]', phone='$_POST[phone]', email='$_POST[email]'		
			, password='$_POST[pass]' WHERE username='$_SESSION[username]'";
			//update the user information
	$sql2="UPDATE system SET emailNotify='$_POST[emailnoti]'";
			
			if($result=$conn->query($sql)){
				echo"successfully updated<br>";
				}
				else{
					echo"error!";
					}
			if($result2=$conn->query($sql2)){
				echo"successfully updated<br>";
				}
				else{
					echo"error!";
					}
	}
	}


}
?>



<div>
<form method="POST">

<input type="hidden" id="username" name="username">
<br></br>
<label>Name:</label>
<input type="text" id="name" name="name">
<br></br>
<label>Phone:</label>
<input type="text" id="phone" name="phone">
<br></br>
<label>E-mail:</label>
<input type="email" id="email" name="email">
<br></br>
<label>E-mail Notify Days:</label>
<input type="text" id="emailnoti" name="emailnoti" placeholder="Enter a number between 1 to 45">
<br></br>
<label>Password:</label>
<input type="password" id="pass" name="pass">
<br></br>
<label>Confirmed Password:</label>
<input type="password" id="pass1" name="pass1">
<br></br>



<input type="submit" id="update_btn" name="Update" value="Update" class="button-sty">
</form>

</div>



</body>
</html>
