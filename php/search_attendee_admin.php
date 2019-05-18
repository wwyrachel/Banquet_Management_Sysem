<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Attendee Search--Rabbit Banquet</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

<script>
var pick;

$(document).ready(function(){
    $("#select tbody tr").click(function(){
        
		$("#select_att").val($(this).find("td").eq(1).html()+" "+$(this).find("td").eq(2).html());
		$("#select_att_phone").val($(this).find("td").eq(7).html());
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


<h1>Search Attendee</h1>	
<div>
<form method="POST">
<label>First Name:</label>
<input type="text" id="fname" name="fname">
<br></br>
<label>Last Name:</label>
<input type="text" id="lname" name="lname">
<br></br>
<label>Attendee Type:</label>
<input type="text" id="type" name="type">
<br></br>
<label>Attending Banquet:</label>
<input type="text" id="banquet" name="banquet">
<br></br>
<label>Affiliated Organization:</label>
<input type="text" id="org" name="org">
<br></br>
<label>Drink Choice:</label>
<input type="text" id="dchoice" name="dchoice">
<br></br>
<label>Meal Choice:</label>
<input type="text" id="mchoice" name="mchoice">
<br></br>

<input type="submit" id="search_btn" name="Asearch" value="Search" class="button-sty">
</form>

</div>
<form method="POST" action="search_attendee_admin.php">
<p>Selected Attendee : <input type="text" id="select_att" name="select_att" name="select_att" placeholder="click the table below" readonly>
<br><br>
<input type="hidden" id="select_att_phone" name="select_att_phone" name="select_att_phone" >
<br><br>
<input type="submit" id="view_detail" name="view_detail" value="Veiw User Profile" class="button-sty">
</form>


<?php 
if (isset($_GET['order'], $_GET['sort'])){
	$order=$_GET['order'];
	$sort=$_GET['sort'];
	
	$sql="SELECT * FROM attendees ORDER BY $order $sort";
	$sort == "DESC" ? $sort = "ASC" : $sort = "DESC";
	
	$result=$conn->query($sql);
	echo "<table id='select' table align='center' table border=1>
	<thead>
	<tr>
	<th><a href='?order=attendB&&sort=$sort'>Attending Banquet</a></th>
	<th><a href='?order=fname&&sort=$sort'>First Name </th>
	<th><a href='?order=lname&&sort=$sort'>Last Name </th>
	<th><a href='?order=dchoice&&sort=$sort'>Drink Choice </th>
	<th><a href='?order=mchoice&&sort=$sort'>Meal Choice </th>
	<th><a href='?order=seatN&&sort=$sort'>Seat Number </th>
	<th><a href='?order=organization&&sort=$sort'>Affliated Organization </th>
	<th><a href='?order=phone&&sort=$sort'>Phone Number </th>
	<th><a href='?order=remark&&sort=$sort'>Remarks </th>
	<th><a href='?order=suggestion&&sort=$sort'>Special Meal and Drinks Suggestions </th>
	
	</tr></thead>";
	
	
	if ($result->num_rows> 0){
		
		echo "<br><br>Found Attendees...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result->num_rows. " records sorted by date...";
		while($row= $result->fetch_assoc()){
		    echo"<tbody>";
			echo"<tr>
			        <td>".$row['attendB']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
				    <td>".$row['dchoice']."</td>
					<td>".$row['mchoice']."</td>
					<td>".$row['seatN']."</td>
					<td>".$row['organization']."</td>
					<td>".$row['phone']."</td>
					<td>".$row['remark']."</td>
					<td>".$row['suggestion']."</td>
				</tr>"
					;
			
		}
		echo "</table>";
		echo"</tbody>";
		
	}else{
		echo "There are no result matching your keyword";
	}
	



	
  }else{
	$order='lname';
	$sort='ASC';
}



if(isset($_POST['Asearch'])){
	
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$type=$_POST["type"];
	$banquet=$_POST["banquet"];
	$org=$_POST["org"];
	$dchoice=$_POST["dchoice"];
	$mchoice=$_POST["mchoice"];
	
	
	
	$sql = "SELECT attendB, fname, lname, mchoice, dchoice, seatN, organization,phone, remark, suggestion FROM attendees  where fname LIKE '%$_POST[fname]%' AND lname LIKE '%$_POST[lname]%' AND type LIKE '%$_POST[type]%'
	AND attendB LIKE '%$_POST[banquet]%' AND organization LIKE '%$_POST[org]%' AND dchoice LIKE '%$_POST[dchoice]%' AND mchoice LIKE '%$_POST[mchoice]%' ORDER BY lname, fname ASC";
	$result=$conn->query($sql);
	echo "<table id='select' table align='center' table border=1>
	<thead>
	<tr>
	<th><a href='?order=attendB&&sort=$sort'>Attending Banquet</a></th>
	<th><a href='?order=fname&&sort=$sort'>First Name </th>
	<th><a href='?order=lname&&sort=$sort'>Last Name </th>
	<th><a href='?order=dchoice&&sort=$sort'>Drink Choice </th>
	<th><a href='?order=mchoice&&sort=$sort'>Meal Choice </th>
	<th><a href='?order=seatN&&sort=$sort'>Seat Number </th>
	<th><a href='?order=organization&&sort=$sort'>Affliated Organization </th>
	<th><a href='?order=phone&&sort=$sort'>Phone Number </th>
	<th><a href='?order=remark&&sort=$sort'>Remarks </th>
	<th><a href='?order=suggestion&&sort=$sort'>Special Meal and Drinks Suggestions </th>
	
	</tr><thead>";
	
	if ($result->num_rows> 0){
		echo "<br><br>Found Attendees...<br>";
		echo "------------------------------------";
		echo "<br>Found " .$result->num_rows. " records sorted by date...";
		while($row= $result->fetch_assoc()){
		    echo"<tbody>";
			echo"<tr>
			        <td>".$row['attendB']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
				    <td>".$row['dchoice']."</td>
					<td>".$row['mchoice']."</td>
					<td>".$row['seatN']."</td>
					<td>".$row['organization']."</td>
					<td>".$row['phone']."</td>
					<td>".$row['remark']."</td>
					<td>".$row['suggestion']."</td>
				</tr>"
					;
			
		}
		echo "</table>";
		echo"</tbody>";
		
	}else{
		echo "There are no result matching your keyword";
	}
	
}

if (isset($_POST["view_detail"])){
	$select_att = $_POST["select_att"];
	$select_att_phone = $_POST["select_att_phone"];
	setcookie("select_att", $select_att);
	setcookie("select_att_phone", $select_att_phone);
	//$type = $_POST["type"];
	//setcookie("type", $type);
	
	echo $_COOKIE['select_att'] ;
	if (empty($select_att) ){
	  echo "<br>Please choose the attendee to view the profile !!!";
	}else{
		header('Location: attendee_profile_admin.php');
	}
}	


?>






</body>
</html>