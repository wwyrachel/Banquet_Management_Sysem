<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Banquet Detail--Rabbit Banquet</title>
<script>
var pick;

$(document).ready(function(){
    $("#select tbody tr").click(function(){
        
		$("#select_att").val($(this).find("td").eq(1).html()+" "+$(this).find("td").eq(2).html());
		//$("#select_att_id").val();
		$("#select_att_phone").val($(this).find("td").eq(5).html());
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
ob_start();
require "config.php";
$select_banq = $_COOKIE['select_banq'];
echo"<h1>$select_banq</h1>";



$sql="SELECT * FROM banquet where banquetName='$select_banq'";
//select all from the users table of the loged in user
$result=$conn->query($sql);
		
		if ($result->num_rows> 0){
			while($row= $result->fetch_assoc()){
			echo "<br>Banquet Name: ".$row["banquetName"]. "<br><br>Date: " .$row["date"]. "<br><br>Time: ".$row["time"]. "<br><br>Address: " .$row["address"]. 
			"<br><br>Location: " .$row["location"]. "<br><br>Staff First Name: " .$row["first_staffN"]. "<br><br>Staff Last Name: " .$row["last_staffN"]. "<br><br>";
			
			
			
			}
		}		

$sql2="SELECT * FROM attendees WHERE attendB =( SELECT id FROM banquet WHERE banquetName= '$select_banq')";
//$sql2="SELECT * FROM attendees ORDER BY $order $sort";
	$sort = "ASC";
	
	$result2=$conn->query($sql2);
	echo "<table id='select' table align='center' table border=1>
	<thead>
	<tr>
	<th><a href='?order=id&&sort=$sort'>User ID </th>
	<th><a href='?order=fname&&sort=$sort'>First Name </th>
	<th><a href='?order=lname&&sort=$sort'>Last Name </th>
	<th><a href='?order=dchoice&&sort=$sort'>Drink Choice </th>
	<th><a href='?order=mchoice&&sort=$sort'>Meal Choice </th>
	<th><a href='?order=phone&&sort=$sort'>Phone Number </th>
	<th><a href='?order=organization&&sort=$sort'>Affliated Organization </th>
	
	
	</tr></thead>";
	
	
	if ($result2->num_rows> 0){
		
		echo "<br><br>Found Attendees...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result2->num_rows. " records...";
		while($row= $result2->fetch_assoc()){
		   	echo"<tbody>";
			echo"<tr>
			        <td>".$row['id']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
				    <td>".$row['dchoice']."</td>
					<td>".$row['mchoice']."</td>
					<td>".$row['phone']."</td>
					<td>".$row['organization']."</td>
					
				</tr>"
					;
			
		}
		echo"<tbody>";
		echo "</table>";
		
	}else{
		echo "There are no result matching your keyword";
	}
	
if (isset($_GET['order'], $_GET['sort'])){
	$order=$_GET['order'];
	$sort=$_GET['sort'];
    $sql2="SELECT * FROM attendees WHERE attendB =( SELECT id FROM banquet WHERE banquetName= '$select_banq') ORDER BY $order $sort";
//$sql2="SELECT * FROM attendees ORDER BY $order $sort";
	$sort == "DESC" ? $sort = "ASC" : $sort = "DESC";
	
	$result2=$conn->query($sql2);
	echo "<table id='select' table align='center' table border=1>
	<thead>
	<tr>
	<th><a href='?order=id&&sort=$sort'>User ID </th>
	<th><a href='?order=fname&&sort=$sort'>First Name </th>
	<th><a href='?order=lname&&sort=$sort'>Last Name </th>
	<th><a href='?order=dchoice&&sort=$sort'>Drink Choice </th>
	<th><a href='?order=mchoice&&sort=$sort'>Meal Choice </th>
	<th><a href='?order=phone&&sort=$sort'>Phone Number</th>
	<th><a href='?order=organization&&sort=$sort'>Affliated Organization </th>
	
	
	</tr><thead>";
	
	
	if ($result2->num_rows> 0){
		
		echo "<br><br>Customize table...<br>";
		echo "<br><br>Found Attendees...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result2->num_rows. " records sorted by date...";
		while($row= $result2->fetch_assoc()){
		   	echo"<tbody>";
			echo"<tr>
			        <td>".$row['id']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
				    <td>".$row['dchoice']."</td>
					<td>".$row['mchoice']."</td>
					<td>".$row['phone']."</td>
					<td>".$row['organization']."</td>
					
				</tr>"
					;
			
		}
		echo"<tbody>";
		echo "</table>";
		
	}else{
		echo "There are no result matching your keyword";
	}
 }else{
	$order='lname';
	$sort='ASC';
}

if (isset($_POST["seat_plan"])){
	$select_banq = $_POST["select_banq"];
	//$select_att_id = $_POST["select_att_id"];
	setcookie("select_banq", $select_banq);
	
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	
	header('Location: construct_table_admin.php');
	
}	
if (isset($_POST["view_detail"])){
	$select_att = $_POST["select_att"];
	$select_att_phone = $_POST["select_att_phone"];
	setcookie("select_att", $select_att);
	setcookie("select_att_phone", $select_att_phone);
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	
	if (empty($select_att) ){
	  echo "<br>Please choose the attendee to view the profile !!!";
	}else{
		header('Location: attendee_profile_admin.php');
	}
}	

?>
<div>
<br><br>
<form method="POST" action="banquet_detail_admin.php">
<input type="hidden" id="select_banq" name="select_banq" value="<?php echo $select_banq;?>" >
<input type="submit" id="seat_plan" name="seat_plan" value="Generate Seat Plan" class="button-sty"><br><br>
Selected Attendee : <input type="text" id="select_att" name="select_att" name="select_att" placeholder="click the table below" readonly>
<br><br>
<input type="hidden" id="select_att_phone" name="select_att_phone" name="select_att_phone" >
<input type="submit" id="view_detail" name="view_detail" value="View Attendee Profile" class="button-sty">
</form>
</div>

<p>
<br><input type="button" class="button" value="Back" onclick="window.location.href='view_all_banquet_admin.php'"/></br></p>


</body>
</html>