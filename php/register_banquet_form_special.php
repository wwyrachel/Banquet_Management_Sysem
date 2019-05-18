<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Register Banquet--Rabbit Banquet</title>

</head>

<body>

	
<?php
include 'config.php';
?>
				
<div class="wrapper row1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index.php">RabbitBanquet</a></h1>
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
<a href="about.php">About</a> &middot;
<a href="register_banquet.php">Register for a Banquet</a> &middot;
<a href="contact.php">Contact</a> 
</div>

<div class="whiteSpace">
</div>


<h1>Register for the Banquet</h1>	
Please fill in your personal information to register in a banquet.<br><br>
<div>
<form method="POST">
<label>First Name:</label>
<input type="text" id="fname" name="fname">
<br></br>
<label>Last Name:</label>
<input type="text" id="lname" name="lname">
<br></br>
<label>Address:</label>
<input type="text" id="address" name="address">
<br></br>
<label>Phone Number:</label>
<input type="tel" id="phone" name="phone">
<br></br>
<label>Affiliated Organization:</label>
<input type="text" id="org" name="org">
<br></br>
<label>E-mail Address:</label>
<input type="email" id="email" name="email">
<br></br>
<label>Drink Choice:</label><br><br>
<input type="radio" name="dchoice" value="Hot Tea" checked> Hot Tea<br>
<input type="radio" name="dchoice" value="Orange Juice" > Orange Juice<br>
<input type="radio" name="dchoice" value="Coke"> Coke<br>
<input type="radio" name="dchoice" value="7 Up"> 7 Up<br>
<br></br>
<label>Meal Choice:</label><br><br>
<input type="radio" name="mchoice" value="Spiced Caultiflower Roast" checked> Spiced Caultiflower Roast<br>
<input type="radio" name="mchoice" value="Spinach & Ricotta Rotolo">Spinach & Ricotta Rotolo<br>
<input type="radio" name="mchoice" value="Baked Stuffed Chicken" >Baked Stuffed Chicken<br>
<input type="radio" name="mchoice" value="Roast Beef and Gravy"> Roast Beef and Gravy<br>
<br></br>
<label>Special Meal Suggestions:</label>
<input type="text" id="suggestion" name="suggestion">
<br></br>
<input type="reset" id="reset_btn" name="reset" value="Reset" class="button-sty">
<input type="submit" id="register_btn" name="register" value="Register" class="button-sty">
</form>

</div>


<?php 
$select_banq_id = $_COOKIE['select_banq_id'];
$type = $_COOKIE['type'];

if (isset($_POST["register"])){
	require "config.php";
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$address=$_POST["address"];
	$phone=$_POST["phone"];
	$org=$_POST["org"];
	$email=$_POST["email"];
	$dchoice=$_POST["dchoice"];
	$mchoice=$_POST["mchoice"];
	$suggestion=$_POST["suggestion"];
	$select_banq_id = $_COOKIE['select_banq_id'];
	$type = $_COOKIE['type'];
	$company="xx";
	$remark="NIL";
	
	
	
	
	if (empty($fname) || empty($email)|| empty($dchoice)|| empty($mchoice)){
		echo "Name, Email, Drink Choice and Meal Choice are required!!";
		}
		
	else{
		//$sql="INSERT INTO 'banquet' ('email', 'banquetName','date', 'time', 'address', 'location', 'staffName' ) VALUES ('$email', '$name', '$date', '$time', '$address', '$location', '$staff')";
		//insert the new record into the activities table in the database
		//$sql="INSERT INTO `banquet`(`email`, `banquetName`, `date`, `time`, `address`, `location`, `staffName`, `locatLat`, `locatLng`) VALUES ('$email','$name','$date','$time','$address','$location','$staff','$lat', '$lng')";
		$sql="INSERT INTO `attendees`(`fname`, `lname`, `type`, `address`, `phone`, 
		`company`, `organization`, `attendB`, `dchoice`, `mchoice`, 
		`remark`, `email`, `payment`, `seatN`, `suggestion`) VALUES ('$fname','$lname','$type',
		'$address','$phone','$company','$org','$select_banq_id','$dchoice','$mchoice','$remark',
		'$email','','','$suggestion')";
		if($conn->query($sql)==TRUE){
			echo"Successfully created!";
			header('Location: register_banquet_success.php');
			}
			else{
				echo"Error!";
			}
		
		}
}
	
	
?>






</body>
</html>