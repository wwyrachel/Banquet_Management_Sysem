<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Report--Rabbit Banquet</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  


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
<a href="search_banquet_admin.php">Search Banquet</a> &middot;
<a href="search_attendee_admin.php">Search Attendee</a> &middot;
<a href="locations_admin.php">Locations</a> &middot;
<a href="report_admin.php">Report</a> &middot;
<a href="setting_password_admin.php">Settings</a> 
</div>

<div class="whiteSpace">
</div>


<h1>Report of Processing Banquet</h1>	

<div>
<br>
<form method="POST" action="report_admin.php">



Selected Banquet : <input type="text" id="select_banq" name="select_banq" name="select_banq" placeholder="click the table below" readonly>
<br>
<input type="hidden" id="select_banq_id" name="select_banq_id" name="select_banq_id" >
<br>
<input type="submit" id="view_report" name="view_report" value="View Report" class="button-sty">
</form>

</div>
<?php 
ob_start();

require "config.php";
	//$all=$_POST["all"];
	
		
	$sql="SELECT * FROM banquet where date >CURDATE() ORDER BY date ASC";
	//use a sql to retrieved the matching book record and sort by book title
	
	$result=$conn->query($sql);
	echo "<table id='select' table align='center' table border=1>
	<thead>
	<tr>
	<th>Banquet Name </th>
	<th>Date </th>
	<th>Time </th>
	<th>E-mail </th>
	<th>Address </th>
	<th>Location </th>
	<th>First Name of Staff in Charge </th>
	<th>Last Name of Staff in Charge </th>
	</tr></thead>";

   
	
	
	if ($result->num_rows> 0){
		echo "<br><br>Banquet In Progress...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result->num_rows. " records sorted by date...";
		while($row= $result->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			echo "<td>".$row["banquetName"]. "</td>";
			echo "<td>".$row["date"]. "</td>";
			echo "<td>".$row["time"]. "</td>";
			echo "<td>".$row["email"]. "</td>";
			echo "<td>".$row["address"]. "</td>";
			echo "<td>".$row["location"]. "</td>";
			echo "<td>".$row["first_staffN"]. "</td>";
			echo "<td>".$row["last_staffN"]. "</td>";
			
			echo "</tr>";
			
		}
		echo "</tbody>";
	}
	else{
		echo "<br>No such record";
	}

	



if (isset($_POST["view_report"])){
	$select_banq = $_POST["select_banq"];
	$select_banq_id = $_POST["select_banq_id"];
	setcookie("select_banq", $select_banq);
	
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	echo $_COOKIE['select_banq'] ;
	
	if (empty($select_banq) ){
	  echo "<br>Please choose the attending banquet to view the report!!!";
	}else{
		header('Location: gen_report_admin.php');
	}
}
?>
</body>
</html>
