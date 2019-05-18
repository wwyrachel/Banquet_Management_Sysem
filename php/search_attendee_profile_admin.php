<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Attendee Profile--Rabbit Banquet</title>

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

require "config.php";
$select_att = $_COOKIE['select_att'];
$select_att_phone= $_COOKIE['select_att_phone'];

echo"<h1>$select_att</h1>";


echo "<br>Your personal information...<br>";

$sql="SELECT * FROM attendees where phone='$select_att_phone'";
//select all from the users table of the loged in user
$result=$conn->query($sql);
		
		if ($result->num_rows> 0){
			while($row= $result->fetch_assoc()){
			$phoneN=$row["phone"];
			$userid=$row["id"];
			echo "<br>User ID: ".$row["id"]."<br><br>First Name: ".$row["fname"]. "<br><br>Last Name: " .$row["lname"]. "<br><br>Attendee Type: ".$row["type"]. "<br><br>Address: " .$row["address"]. 
			"<br><br>Phone Number: " .$row["phone"]. "<br><br>Email: " .$row["email"]. "<br><br>Company: " .$row["company"]. "<br><br>
			Affliated Organization: " .$row["organization"]. "<br><br>Drink Choice: " .$row["dchoice"]. "<br><br>Meal Choice: " .$row["mchoice"]. "<br>
			<br>Remarks: " .$row["remark"]. "<br><br>";
			
			
			
			}
		}	
		

$sql2="SELECT banquetName, date, time ,address FROM banquet WHERE id IN (SELECT attendB FROM attendees where phone =$phoneN)";

	
	
	$result2=$conn->query($sql2);
	echo "<table id='select' align='center' table border=1>
	<thead>
	
	<tr>
	
	<th>Banquet Name </th>
	<th>Date </th>
	<th>Time </th>
	
	<th>Address </th>
	
	</tr></thead>";

   
	
	
	if ($result2->num_rows> 0){
		echo "<br><br>All banquet join...<br>";
		echo "------------------------------------";
		while($row= $result2->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			
			echo "<td>".$row["banquetName"]. "</td>";
			echo "<td>".$row["date"]. "</td>";
			echo "<td>".$row["time"]. "</td>";
			
			echo "<td>".$row["address"]. "</td>";
			
			
			echo "</tr>";
			
		
		}
		echo "</tbody>";
		
	}
	else{
		echo "<br>No such record";
	}
	
if (isset($_POST["Edit"])){
	
	setcookie("userid", $userid);
	
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	
	if (empty($select_att) ){
	  echo "<br>Please choose the attendee to view the profile !!!";
	}else{
		header('Location: edit_attendee_profile_admin.php');
	}
}	

?>
</div>
<form method="POST" action="search_attendee_profile_admin.php">
Selected Attendee : <input type="text" id="select_att" name="select_att" name="select_att" placeholder="click the table below" >
<br><br>
<input type="hidden" id="select_att_phone" name="select_att_phone" name="select_att_phone" >
<br><br>

<br>
<input type="submit" id="edit_btn" name="Edit" value="Edit" class="button-sty">
</form>



</body>
</html>