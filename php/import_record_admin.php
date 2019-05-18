<?php
include("csv.php");
$csv = new csv();
if (isset($_POST['sub'])){
	$csv->import($_FILES['file']['tmp_name']);
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Import Attendee Record--Rabbit Banquet</title>

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


<h1>Import Atendees</h1>
Select a file in .csv format to import attendees<br><br>	
<form method="post" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" name="sub" value="Import">
</form>

<div class="whiteSpace">
</div>
<br>Sample format of the *.csv file:</br>
<p><p><img src="csv_sample_pic.jpg" width="800px" height="350px"></p>

</body>
</html>