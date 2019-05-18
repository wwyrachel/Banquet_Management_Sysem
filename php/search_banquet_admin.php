<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Search Banquet--Rabbit Banquet</title>

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


<h1>Search Banquet</h1>	
<div>
<form method="POST">
<label>Banquet Keyword:</label>
<input type="text" id="keywords" name="keywords">
<br></br>
<label>Banquet Date:</label>
<input type="text" id="Sdate" name="Sdate" value="2015-01-01" placeholder="Start date">
to
<input type="text" id="Edate" name="Edate" value="2022-01-01" placeholder="End date">
<br></br>

<input type="submit" id="search_btn" name="Bsearch" value="Search" class="button-sty">
</form>

</div>


<?php
if (isset($_GET['order'], $_GET['sort'])){
	$order=$_GET['order'];
	$sort=$_GET['sort'];
	
	$sql="SELECT * FROM banquet ORDER BY $order $sort";
	$sort == "DESC" ? $sort = "ASC" : $sort = "DESC";
	
	$result=$conn->query($sql);
	echo "<table align='center' table border=1>
	<tr>
	<th><a href='?order=banquetName&&sort=$sort'>Banquet Name </th>
	<th><a href='?order=date&&sort=$sort'>Date </th>
	
	</tr>";
	
	
	if ($result->num_rows> 0){
		
		echo "<br><br>Found Attendees...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result->num_rows. " records sorted by date...";
		while($row= $result->fetch_assoc()){
		   
			echo"<tr>
			        <td>".$row['banquetName']."</td>
					<td>".$row['date']."</td>
					
				</tr>"
					;
			
		}
		echo "</table>";
		
	}else{
		echo "<br>There are no result matching your keyword";
	}
	



	
  }else{
	$order='banquetName';
	$sort='ASC';
}


 

if(isset($_POST['Bsearch'])){
	
	$search=$_POST["keywords"];
	$Sdate=$_POST["Sdate"];
	$Edate=$_POST["Edate"];
	
	
	$sql = "SELECT * FROM banquet WHERE banquetName LIKE '%$search%' AND date BETWEEN '$Sdate' AND '$Edate' ORDER BY $order $sort";
	$result=$conn->query($sql);
	echo "<table align='center' table border=1>
	<tr>
	<th><a href='?order=banquetName&&sort=$sort'>Banquet Name </th>
	<th><a href='?order=date&&sort=$sort'>Date </th>
	
	</tr>";
	
	if ($result->num_rows> 0){
		echo "<br><br>Found Banquets...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result->num_rows. " records sorted by banquet name...";
		while($row= $result->fetch_assoc()){
		
			echo"<tr>
					<td>".$row['banquetName']."</td>
					<td>".$row['date']."</td>
					
				</tr>"
					;
			
		}
		echo "</table>";
		
	}else{
		echo "<br>There are no result matching your keyword";
	}
	
}
?>
</body>
</html>