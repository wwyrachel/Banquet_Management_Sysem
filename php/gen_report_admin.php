<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

<title>Report-Rabbit Banquet</title>

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

require "config.php";
$select_banq = $_COOKIE['select_banq'];


echo"<h1>$select_banq</h1>";






$sql="SELECT seatN, dchoice, mchoice FROM attendees WHERE attendB= (SELECT id FROM banquet WHERE banquetName = '$select_banq')";
//$sql="SELECT seatN, dchoice, mchoice FROM attendees WHERE attendB= 56 ";

	
	
	$result=$conn->query($sql);
	echo "<table id='select' align='center' table border=1>
	<thead>
	
	<tr>
	<th>Seat Number </th>
	<th>Drink Choice </th>
	<th>Meal Choice </th>
	
	
	
	
	</tr></thead>";

   
	
	
	if ($result->num_rows> 0){
		//echo "<br><br>All banquet join...<br>";
		echo "------------------------------------";
		while($row= $result->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			
			echo "<td>".$row["seatN"]. "</td>";
			echo "<td>".$row["dchoice"]. "</td>";
			echo "<td>".$row["mchoice"]. "</td>";
			
			
			
			echo "</tr>";
			
		
		}
		echo "</tbody>";
		
	}
	else{
		echo "<br>No such record";
	}
	
$sql5="SELECT dchoice, count(*) as count FROM attendees WHERE attendB= (SELECT id FROM banquet WHERE banquetName = '$select_banq') GROUP BY dchoice";
//$sql="SELECT seatN, dchoice, mchoice FROM attendees WHERE attendB= 56 ";

	
	
	$result5=$conn->query($sql5);
	echo "<table id='select' align='center' table border=1>
	<thead>
	
	<tr>
	
	<th>Drink Choice </th>
	<th>Total </th>
	
	
	
	
	</tr></thead>";

   
	
	
	if ($result5->num_rows> 0){
		//echo "<br><br>All banquet join...<br>";
		echo "------------------------------------";
		while($row= $result5->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			
			
			echo "<td>".$row["dchoice"]. "</td>";
			echo "<td>".$row["count"]. "</td>";
			
			
			
			echo "</tr>";
			
		
		}
		echo "</tbody>";
		
	}
	else{
		echo "<br>No such record";
	}
	
$sql6="SELECT mchoice, count(*) as count FROM attendees WHERE attendB= (SELECT id FROM banquet WHERE banquetName = '$select_banq') GROUP BY mchoice";
//$sql="SELECT seatN, dchoice, mchoice FROM attendees WHERE attendB= 56 ";

	
	
	$result6=$conn->query($sql6);
	echo "<table id='select' align='center' table border=1>
	<thead>
	
	<tr>
	
	<th>Meal Choice </th>
	<th>Total </th>
	
	
	
	
	</tr></thead>";

   
	
	
	if ($result6->num_rows> 0){
		//echo "<br><br>All banquet join...<br>";
		echo "------------------------------------";
		while($row= $result6->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			
			
			echo "<td>".$row["mchoice"]. "</td>";
			echo "<td>".$row["count"]. "</td>";
			
			
			
			echo "</tr>";
			
		
		}
		echo "</tbody>";
		
	}
	else{
		echo "<br>No such record";
	}
	
	

if (isset($_POST["export_pdf"])){
	require "config.php";
	//$all=$_POST["all"];
	
		
	$sql2="SELECT seatN, dchoice, mchoice FROM attendees WHERE attendB= (SELECT id FROM banquet WHERE banquetName = '$select_banq')";
	//use a sql to retrieved the matching book record and sort by book title
	
	$result2=$conn->query($sql2);
	echo "<table id='select' table id='export' align='center' table border=1>
	<thead>
	<tr>
	<th>Seat Number </th>
	<th>Drink Choice </th>
	<th>Meal Choice </th>
	</tr></thead>";

   
	
	
	if ($result2->num_rows> 0){
		echo "<br><br>Finished Banquets...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result2->num_rows. " records sorted by date...";
		while($row= $result2->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			echo "<td>".$row["seatN"]. "</td>";
			echo "<td>".$row["dchoice"]. "</td>";
			echo "<td>".$row["mchoice"]. "</td>";
			
			
			echo "</tr>";
			
		}
		echo "</tbody>";
		//header_remove();
		 header("Content-type:application/doc");
		 
         header("Content-Disposition:attachment;filename='report.doc'");
		
	}
	else{
		echo "<br>No such record";
	}





}

?>

<div>
<form method="POST">


<input type="submit" id="export_pdf" name="export_pdf" value="Export" class="button-sty">
<br>

</form>
</div>
<?php 


	require "config.php";
	
	
		
	$sql="SELECT dchoice, count(*) as count FROM attendees WHERE attendB = (SELECT id FROM banquet WHERE banquetName = '$select_banq') GROUP BY dchoice";
	$sql2="SELECT mchoice, count(*) as count FROM attendees WHERE attendB = (SELECT id FROM banquet WHERE banquetName = '$select_banq') GROUP BY mchoice";
	$sql3="SELECT type, count(*) as count FROM attendees WHERE attendB = (SELECT id FROM banquet WHERE banquetName = '$select_banq') GROUP BY type";
	
	
	
	
	$result=$conn->query($sql);
	$result2=$conn->query($sql2);
	$result3=$conn->query($sql3);	
	?>
<p><p>	
<div id="barchart_drink" align='center' style="width: 900px; height: 370px;"></div>
<p><p>
<div id="barchart_meal" align='center' style="width: 900px; height: 370px;"></div>
<p><p>

<div id="piechart_type" align='center' style="width: 900px; height: 370px;"></div>
<p><p>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawDrinkChart);
	google.charts.setOnLoadCallback(drawMealChart);
	google.charts.setOnLoadCallback(drawTypeChart);
	
	function drawDrinkChart() {
      var data = google.visualization.arrayToDataTable([
        ["Drink Choice", "Number of selected attendees" ],
        <?php
		while($row= $result->fetch_assoc()){
			echo "['".$row["dchoice"]."', ".$row["count"]."],";
             			
		}
		
		?>
		
      ]);

	 

      var options = {
        title: "Drink distribution of the banquet",
        width: 600,
        height: 400,
        bar: {groupWidth: "75%"},
        legend: { position: "none" },
		colors: ['#f6b5b5', '#f6b5b5', '#f6b5b5', '#f6b5b5', '#f6b5b5'],
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_drink"));
      chart.draw(data, options);
  }
  
  //---------------------------------------------------------------------------
  
  function drawMealChart() {
      var data = google.visualization.arrayToDataTable([
        ["Meal Choice", "Number of selected attendees" ],
        <?php
		while($row= $result2->fetch_assoc()){
			echo "['".$row["mchoice"]."', ".$row["count"]."],";
             			
		}
		
		?>
		
      ]);

	 

      var options = {
        title: "Meal distribution of the banquet",
        width: 600,
        height: 400,
        bar: {groupWidth: "75%"},
        legend: { position: "none" },
		colors: ['#b5f6d3', '#b5f6d3', '#b5f6d3', '#b5f6d3', '#b5f6d3'],
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_meal"));
      chart.draw(data, options);
  }
  
   //---------------------------------------------------------------------
function drawTypeChart() {
      var data = google.visualization.arrayToDataTable([
        ["Attendee Type", "Number" ],
        <?php
		while($row= $result3->fetch_assoc()){
			echo "['".$row["type"]."', ".$row["count"]."],";
             			
		}
		
		?>
      ]);
      
	  
      var options = {
        title: "Percentage of different type of attendees",
       
      };
      var chart = new google.visualization.PieChart(document.getElementById("piechart_type"));
      chart.draw(data, options);
  }
  
  
  
</script>

</body>
</html>