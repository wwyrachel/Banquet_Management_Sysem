<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Change Payment Info--Rabbit Banquet</title>

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
<h1>Edit Payment Status</h1>

<?php
$select_banq = $_COOKIE['select_banq'];
$userid= $_COOKIE['userid'];


if (isset($_POST["payment"])){
	require "config.php";
	
	$pay=$_POST["pay"];
	
	
	
	
	
		//$sql="INSERT INTO 'banquet' ('email', 'banquetName','date', 'time', 'address', 'location', 'staffName' ) VALUES ('$email', '$name', '$date', '$time', '$address', '$location', '$staff')";
		//insert the new record into the activities table in the database
		//$sql="INSERT INTO `banquet`(`email`, `banquetName`, `date`, `time`, `address`, `location`, `staffName`, `locatLat`, `locatLng`) VALUES ('$email','$name','$date','$time','$address','$location','$staff','$lat', '$lng')";
		$sql="UPDATE `attendees` SET `payment` = '$pay' WHERE id= '$userid' AND attendB= (SELECT id FROM banquet WHERE banquetName= '$select_banq')";
		if($conn->query($sql)==TRUE){
			echo"Successfully Updated!";
			//header('Location: register_banquet_success.php');
			
			}
			else{
				echo"Error!";
			}
		
		
}
	
?>



<div>
<form method="POST">

<label>Payment Status:</label>
<br>
<input type="radio" name="pay" value="Unpaid" checked> Unpaid<br>
<input type="radio" name="pay" value="Paid_by_cash">Paid-By Cash<br>
<input type="radio" name="pay" value="Paid_by_card" >Paid-By Card<br>
<input type="radio" name="pay" value="Paid_by_eps"> Paid-By EPS<br>
<input type="radio" name="pay" value="Paid_by_cheque"> Paid-By Cheque<br>
<br></br>


<input type="submit" id="payment_btn" name="payment" value="Confirm" class="button-sty">
</form>




</div>



</body>
</html>
