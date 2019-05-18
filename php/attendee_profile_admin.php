<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Admin Profile--Rabbit Banquet</title>
<script>
var pick;

$(document).ready(function(){
    $("#select tbody tr").click(function(){
        
		$("#select_banq").val($(this).find("td").eq(0).html());
		$("#select_banq_id").val($(this).find("td").eq(0).html());
        $( this ).css( "background-color", "yellow" );
 
          pick = $( this );
    });
	$("#select tbody tr").hover(function(){
	$( this ).css( "background-color", "pink" );}, function(){
        $(this).css("background-color", "white");
		
    });
});
</script>
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
$select_att_phone = $_COOKIE['select_att_phone'];

echo"<h1>$select_att</h1>";


echo "<br>Your personal information...<br>";

$sql="SELECT * FROM attendees where phone='$select_att_phone'";
//select all from the users table of the loged in user
$result=$conn->query($sql);
		
		if ($result->num_rows> 0){
			while($row= $result->fetch_assoc()){
			
			echo "<br>User ID: ".$row["id"]. "<br><br>First Name: ".$row["fname"]. "<br><br>Last Name: " .$row["lname"]. "<br><br>Attendee Type: ".$row["type"]. "<br><br>Address: " .$row["address"]. 
			"<br><br>Phone Number: " .$row["phone"]. "<br><br>Email: " .$row["email"]. "<br><br>Company: " .$row["company"]. "<br><br>
			Affliated Organization: " .$row["organization"]. "<br><br>Drink Choice: " .$row["dchoice"]. "<br><br>Meal Choice: " .$row["mchoice"]. "<br>
			<br>Remarks: " .$row["remark"]. "<br><br>";
			
			$userid=$row["id"];
			
			
			}
		}	
		

$sql2="SELECT banquetName, date, time ,address FROM banquet WHERE id IN (SELECT attendB FROM attendees where phone = '$select_att_phone')";

	
	
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
		echo "------------------------------------<br>";
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
	
if (isset($_POST["edit"])){
	//$select_banq = $_POST["select_banq"];
	setcookie("userid", $userid);
	
	//echo $_COOKIE['select_banq'] ;
	
    header('Location: edit_attendee_info_admin.php');
	
}
if (isset($_POST["payment"])){
	$select_banq = $_POST["select_banq"];
	setcookie("userid", $userid);
	setcookie("select_banq", $select_banq);
	//echo $_COOKIE['select_banq'] ;
	
    header('Location: edit_payment_status_admin.php');
	
}
?>

<div>

<form method="POST" action="attendee_profile_admin.php">
<br>
<input type="submit" id="edit" name="edit" value="Edit Attendee Profile" class="button-sty">
<br><br>
Selected Banquet : <input type="text" id="select_banq" name="select_banq" name="select_banq" placeholder="click the table below" readonly>
<br><br>
<input type="hidden" id="select_banq_id" name="select_banq_id" name="select_banq_id" >

<input type='submit' name='payment' value='Edit Payment Status!' class="button-sty"><br>

<br></form>
</div>
</body>
</html>