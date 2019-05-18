<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Construct Seat Plan--Rabbit Banquet</title>

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


<?php
$select_banq = $_COOKIE['select_banq'];

echo "<h1>Seat Plan Arrangement for '$select_banq'</h1>";
if (isset($_POST["confirm"])){
	require "config.php";
	
	
	$shape_vip=$_POST["shape_vip"];
	$shape_spon=$_POST["shape_spon"];
	$shape_oth=$_POST["shape_oth"];
	$seat_vip=$_POST["seat_vip"];
	$seat_spon=$_POST["seat_spon"];
	$seat_oth=$_POST["seat_oth"];
	$meal_first=$_POST["meal_first"];
	$meal_sec=$_POST["meal_sec"];
	$meal_third=$_POST["meal_third"];
	$meal_four=$_POST["meal_four"];
	
	
	echo $shape_vip;
	echo $shape_spon;
	echo $shape_oth;
	echo $seat_vip;
	echo $seat_spon;
	echo $seat_oth;
	
	
		
		$sql2="UPDATE `tables` SET `shape_vip` = '$shape_vip', `shape_spon` = '$shape_spon', 
		`shape_oth` = '$shape_oth', `seat_vip` = '$seat_vip', `seat_spon` = '$seat_spon',`seat_oth` = '$seat_oth',
		`arr_1` = '$meal_first', `arr_2` = '$meal_sec', `arr_3` = '$meal_third', `arr_4` = '$meal_four' WHERE banquet_id= (SELECT id FROM banquet WHERE banquetName= '$select_banq') ";
		if($conn->query($sql2)==TRUE){
			echo"Successfully inserted!";
			//header('Location: register_banquet_success.php');
			
			}
			else{
				echo"Error!";
			}
		
		
}

if (isset($_POST["confirm"])){
	$select_banq = $_POST["select_banq"];
	//$select_att_id = $_POST["select_att_id"];
	setcookie("select_banq", $select_banq);
	
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	
	header('Location: draw_table_admin.php');
	
}	
	
?>



<div>
<form method="POST">

<label>What is the shape of the banquet table for VIP?</label>
<br>
<input type="radio" name="shape_vip" value="circle" checked> Circle<br>
<input type="radio" name="shape_vip" value="oval">Oval<br>
<input type="radio" name="shape_vip" value="rectangle" >Rectangle<br>

<br></br>

<label>What is the shape of the banquet table for Sponsors?</label>
<br>
<input type="radio" name="shape_spon" value="circle" checked> Circle<br>
<input type="radio" name="shape_spon" value="oval">Oval<br>
<input type="radio" name="shape_spon" value="rectangle" >Rectangle<br>

<br></br>
<label>What is the shape of the rest of the banquet table?</label>
<br>
<input type="radio" name="shape_oth" value="circle" checked> Circle<br>
<input type="radio" name="shape_oth" value="oval">Oval<br>
<input type="radio" name="shape_oth" value="rectangle" >Rectangle<br>

<br></br>
----------------------------------<br><br>
<label>How many seats are there in a banquet table for VIP?</label>
<br>
<input type="text" name="seat_vip"  placeholder="Number between 1-14"> 


<br></br>

<label>How many seats are there in a banquet table for Sponsors?</label>
<br>
<input type="text" name="seat_spon"  placeholder="Number between 1-14"> 


<br></br>
<label>How many seats are there for the rest of the banquet table?</label>
<br>
<input type="text" name="seat_oth"  placeholder="Number between 1-14"> 
<br></br>
<label>Which meal choice should be arrange first?</label>
<br>
<input type="radio" name="meal_first" value="first choice" checked> First Choice<br>
<input type="radio" name="meal_first" value="second choice">Second Choice<br>
<input type="radio" name="meal_first" value="third choice" >Third Choice<br>
<input type="radio" name="meal_first" value="fourth choice" >Fourth Choice<br>

<br></br>
<label>Which meal choice should be arrange secondly?</label>
<br>
<input type="radio" name="meal_sec" value="first choice" > First Choice<br>
<input type="radio" name="meal_sec" value="second choice"checked>Second Choice<br>
<input type="radio" name="meal_sec" value="third choice" >Third Choice<br>
<input type="radio" name="meal_sec" value="fourth choice" >Fourth Choice<br>

<br></br>
<label>Which meal choice should be arrange thirdly?</label>
<br>
<input type="radio" name="meal_third" value="first choice" > First Choice<br>
<input type="radio" name="meal_third" value="second choice">Second Choice<br>
<input type="radio" name="meal_third" value="third choice" checked>Third Choice<br>
<input type="radio" name="meal_third" value="fourth choice" >Fourth Choice<br>

<br></br>
<label>Which meal choice should be arrange fourthly?</label>
<br>
<input type="radio" name="meal_four" value="first choice" > First Choice<br>
<input type="radio" name="meal_four" value="second choice">Second Choice<br>
<input type="radio" name="meal_four" value="third choice" >Third Choice<br>
<input type="radio" name="meal_four" value="fourth choice" checked>Fourth Choice<br>

<br></br>
<input type="hidden" id="select_banq" name="select_banq" value="<?php echo $select_banq;?>" >


<input type="submit" id="confirm" name="confirm" value="Confirm" class="button-sty">
</form>




</div>




</body>
</html>
