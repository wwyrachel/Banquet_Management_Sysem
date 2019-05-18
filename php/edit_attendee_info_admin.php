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
<h1>Edit Attendee Profile</h1>

<?php
$userid = $_COOKIE['userid'];

if (isset($_POST["Edit"])){
	require "config.php";

	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$type= $_POST["type"];
	$address=$_POST["address"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$company=$_POST["company"];
	$org= $_POST["org"];
	$dchoice=$_POST["dchoice"];
	$mchoice=$_POST["mchoice"];
	$sugg=$_POST["sugg"];
	
	

	
	$sql="UPDATE attendees SET fname='$_POST[fname]', lname='$_POST[lname]', type='$_POST[type]'		
			, address='$_POST[address]', phone='$_POST[phone]', email='$_POST[email]'
            , company='$_POST[company]', org='$_POST[org]', dchoice='$_POST[dchoice]'
            , mchoice='$_POST[mchoice]', , sugg='$_POST[sugg]' WHERE username='$userid'";
			//update the user information
			
			if($result=$conn->query($sql)){
				echo"successfully updated<br>";
				}
				else{
					echo"error!";
					}
	
	


}
?>



<div>
<form method="POST">

<input type="hidden" id="username" name="username">
<br></br>
<label>First Name:</label>
<input type="text" id="fname" name="fname">
<br></br>
<label>Last Name:</label>
<input type="text" id="lname" name="lname">
<br></br>
<label>Attendee Type:</label>
<input type="text" id="type" name="type">
<br></br>
<label>Address:</label>
<input type="text" id="address" name="address">
<br></br>
<label>Phone Number:</label>
<input type="text" id="phone" name="phone">
<br></br>
<label>Email:</label>
<input type="email" id="email" name="email">
<br></br>
<label>Company:</label>
<input type="text" id="company" name="company">
<br></br>
<label>Affliated Organization:</label>
<input type="text" id="org" name="org">
<br></br>
<label>Drink Choice:</label>
<input type="text" id="dchoice" name="dchoice">
<br></br>
<label>Meal Choice:</label>
<input type="text" id="mchoice" name="mchoice">
<br></br>
<label>Remarks:</label>
<input type="text" id="remark" name="remark">
<br></br>
<label>Special Suggestions:</label>
<input type="text" id="sugg" name="sugg">
<br></br>



<input type="submit" id="edit_btn" name="Edit" value="Edit" class="button-sty">
</form>

</div>



</body>
</html>
