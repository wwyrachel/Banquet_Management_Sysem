<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Seat Plan--Rabbit Banquet</title>

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
ob_start();
$select_banq = $_COOKIE['select_banq'];
echo "<h1>$select_banq</h1>";
require "config.php";
//echo "Welcome ".$_SESSION["username"]. "! Welcome to our library system!";
//echo "<br>Your personal information...<br>";

$sql="SELECT * FROM tables where banquet_id= (SELECT id FROM banquet WHERE banquetName = '$select_banq')";
//select all from the users table of the loged in user
$result=$conn->query($sql);
		
		if ($result->num_rows> 0){
			while($row= $result->fetch_assoc()){
			echo "<br>Table shape of VIP: ".$row["shape_vip"]. "<br><br>Table shape of sponsor: " .$row["shape_spon"]. "<br><br>Table shape of other attendee: ".$row["shape_oth"]. "<br><br>Seat Number in VIP tables: " .$row["seat_vip"]. 
			"<br><br>Seat Number in Spsoner Table : " .$row["seat_spon"]. "<br><br>Seat Number in Other Attendee Table : " .$row["seat_oth"]. "<br>";
			$shape_vip= $row["shape_vip"];
			$shape_spon= $row["shape_spon"];
			$shape_oth= $row["shape_oth"];
			$seat_vip= $row["seat_vip"];
			$seat_spon= $row["seat_spon"];
			$seat_oth= $row["seat_oth"];
			
			}
		}

	
$sql2="SELECT fname, lname, seatN FROM attendees WHERE attendB =(SELECT id FROM banquet WHERE banquetName='$select_banq') ORDER BY seatN";
//use a sql to retrieved the matching book record and sort by book title

$result2=$conn->query($sql2);
echo "<table id='select' table align='center' table border=1>
<thead>
<tr>
<th>First Name </th>
<th>Last Name </th>
<th>Seat No </th>

</tr></thead>";




if ($result2->num_rows> 0){
	//echo "<br><br>Banquet In Progress...<br>";
	//echo "------------------------------------";
	//echo "<br>Found " .$result->num_rows. " records sorted by date...";
	while($row= $result2->fetch_assoc()){
		echo"<tbody>";
		echo"<tr>";
		echo "<td>".$row["seatN"]. "</td>";
		echo "<td>".$row["fname"]. "</td>";
		echo "<td>".$row["lname"]. "</td>";
		
		
		echo "</tr>";
		
	}
	echo "</tbody>";
}
else{
	echo "<br>No such record";
}




if ($shape_vip=="circle"){
	echo "<img src='circle.png' border=0>";
}elseif($shape_vip=="oval"){
	echo "<img src='oval.png' border=0>";
}elseif($shape_vip=="rectangle"){
	echo "<img src='rectangle.png' border=0>";
}
//-------------------------------------
if ($shape_spon=="circle"){
	echo "<img src='circle.png' border=0>";
}elseif($shape_spon=="oval"){
	echo "<img src='oval.png' border=0>";
}elseif($shape_spon=="rectangle"){
	echo "<img src='rectangle.png' border=0>";
}

//-------------------------------------
if ($shape_oth=="circle"){
	echo "<img src='circle.png' border=0>";
}elseif($shape_oth=="oval"){
	echo "<img src='oval.png' border=0>";
}elseif($shape_oth=="rectangle"){
	echo "<img src='rectangle.png' border=0>";
}

if (isset($_POST["export"])){
	
		 header('Content-Type: application/xls');  
         header('Content-disposition: attachment; filename=allBanquetRecords.xls');  



}


?>
<div>
<br><p>
<form method="POST" action="draw_table_admin.php">


<input type="submit" id="export" name="export" value="Export to Excel" class="button-sty">
<br>
</form>
</div>



</body>
</html>
