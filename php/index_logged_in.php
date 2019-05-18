<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Menu--Rabbit Banquet</title>
<script>
function loadImg(number){
	var link = "store_images.php?id="+ number;
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("imgDiv").innerHTML= xmlhttp.responseText;
		
		}
	};
	
	xmlhttp.open("GET", link, true);
	xmlhttp.send();
	setTimeout("loadImg("+(number+1)+")", 2000);
}
</script>

</head>

<body onload= "loadImg(0)">		
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
	echo "<div id=\"forgot\"><a href=\"pages/register.php\">Register</a> or <a href=\"#\">Forgot Your Password?</a></div>";
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

<div id= "imgDiv">

</div>

</body>
</html>