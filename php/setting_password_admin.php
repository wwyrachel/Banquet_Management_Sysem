<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Info--Rabbit Banquet</title>

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


<h1>Change Password</h1>	


<?php

require "config.php";
echo "Welcome ".$_SESSION["username"]. "! Welcome to our library system!";
echo "<br>Your personal information...<br>";

$sql="SELECT * FROM admin where username='$_SESSION[username]'";
//select all from the users table of the loged in user
$result=$conn->query($sql);
		
		if ($result->num_rows> 0){
			while($row= $result->fetch_assoc()){
			echo "<br>Username: ".$row["username"]. "<br><br>Password: " .$row["password"]. "<br><br>Name: ".$row["name"]. "<br><br>Phone: " .$row["phone"]. 
			"<br><br>Email: " .$row["email"]. "<br>";
			
			
			
			}
		}		

$sql2="SELECT emailNotify FROM system";
//select all from the users table of the loged in user
$result2=$conn->query($sql2);
		
		if ($result2->num_rows> 0){
			while($row= $result2->fetch_assoc()){
			echo "<br>Email Notify Days: ".$row["emailNotify"]. "<br>";
			
			
			
			}
		}		


?>

<p>
<br><input type="button" class="button" value="Edit" onclick="window.location.href='update.php'"/></br></p>

</body>
</html>