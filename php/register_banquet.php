<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Register Banquet--Rabbit Banquet</title>
<script>
var pick;

$(document).ready(function(){
    $("#select tbody tr").click(function(){
        
		$("#select_banq").val($(this).find("td").eq(1).html());
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
      <h1><a href="index.php">RabbitBanquet</a></h1>
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
<a href="about.php">About</a> &middot;
<a href="register_banquet.php">Register for a Banquet</a> &middot;
<a href="contact.php">Contact</a> 
</div>


<div class="whiteSpace">
</div>


<h1>Select a Banquet</h1>	
Click one of the banquets below to register!!<br><br>
<form method="POST" action="register_banquet.php">
Selected Banquet : <input type="text" id="select_banq" name="select_banq" name="select_banq" placeholder="click the table below" >
<br><br>
<input type="hidden" id="select_banq_id" name="select_banq_id" name="select_banq_id" >

<label>Attendee Type:</label><br>
<input type="radio" name="type" value="Sponsors" > Sponsors<br>
<input type="radio" name="type" value="VIP">VIP<br>
<input type="radio" name="type" value="Others" checked>Others<br>

<br></br>
<input type='submit' name='register' value='Register Now!' class="button-sty"><br>
</form>


<?php 

require "config.php";
	//$all=$_POST["all"];
	
		
	$sql="SELECT * FROM banquet where date >CURDATE() ORDER BY date ASC";
	//use a sql to retrieved the matching book record and sort by book title
	
	$result=$conn->query($sql);
	echo "<table id='select' align='center' table border=1>
	<thead>
	
	<tr>
	<th>Banquet ID </th>
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
		while($row= $result->fetch_assoc()){
			echo"<tbody>";
			echo"<tr>";
			echo "<td>".$row["id"]. "</td>";
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


if (isset($_POST["register"])){
	$select_banq = $_POST["select_banq"];
	$select_banq_id = $_POST["select_banq_id"];
	setcookie("select_banq_id", $select_banq_id);
	$type = $_POST["type"];
	setcookie("type", $type);
	
	//echo $_COOKIE['select_banq'] ;
	if (empty($select_banq)|| empty($type) ){
	  echo "<br>Please choose the attending banquet and attendee type!!!";
	}elseif ($type == "Others"){
		header('Location: register_banquet_form_others.php');
	}else{
		header('Location: register_banquet_form_special.php');
	}
}
?>


</body>
</html>