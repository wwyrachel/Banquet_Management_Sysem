<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
#map {
        height: 600px;
        width: 100%;
       }
</style>

<title>Banquet Locations--Rabbit Banquet</title>

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

<h1>Banquets Locations</h1>
<?php 


	require "config.php";
	
	
		
	$sql="SELECT * FROM banquet";
	
	$result=$conn->query($sql);
	echo "<table align='center' table border=1>
	<tr>
	<th>Banquet Name </th>
	<th>Date </th>
	<th>Time </th>
	<th>E-mail </th>
	<th>Address </th>
	<th>Location </th>
	<th>Staff First Name </th>
	<th>Staff Last Name </th>
	
	
	</tr>";
	
	
	
	if ($result->num_rows> 0){
		
		echo "<p>Found " .$result->num_rows. " banquets...<p>";
		while($row= $result->fetch_assoc()){
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
	}
	else{
		echo "<br>No such record";
	}


	$sql="SELECT locatLat FROM banquet";
	
	$result=$conn->query($sql);
	echo "<table align='center' table border=1>
	<tr>
	
	
	</tr>";
	
	
	$x=0;
	
	if ($result->num_rows> 0){
		
		
		while($row= $result->fetch_assoc()){
			
			$data[$x] =$row;
			$x++;
		}
	}
	else{
		echo "<br>No such record";
	}
	
	$lati=array();
	$s=0;
	
	for ($k=0; $k<count($data); $k++){
		foreach($data[$k] as $x => $x_value) {
			
			$lati[$s]=$x_value;
			$s++;
			//echo $s;
			echo "<br>";
			}
	}
	
	
	
	
	
	$sql="SELECT locatLng FROM banquet";
	
	$result=$conn->query($sql);
	
	
	$x1=0;
	
	if ($result->num_rows> 0){
		
		
		while($row= $result->fetch_assoc()){
			
			$data1[$x1] =$row;
			$x1++;
		}
	}
	else{
		echo "<br>No such record";
	}
	
	$lngn=array();
	$s1=0;
	
	for ($k1=0; $k1<count($data1); $k1++){
		foreach($data1[$k1] as $x1 => $x_value1) {
			
			$lngn[$s1]=$x_value1;
			$s1++;
			
			}
	}
	
	
	$sql4="SELECT address FROM banquet";
	
	$result4=$conn->query($sql4);
	
	
	$x4=0;
	
	if ($result4->num_rows> 0){
		
		
		while($row= $result4->fetch_assoc()){
			
			$data4[$x4] =$row;
			$x4++;
		}
	}
	else{
		echo "<br>No such record";
	}
	
	$score=array();
	$s4=0;
	
	for ($k4=0; $k4<count($data4); $k4++){
		foreach($data4[$k4] as $x4 => $x_value4) {
			
			$score[$s4]=$x_value4;
			$s4++;
			
			}
	}
	
	
	$sql5="SELECT banquetName FROM banquet";
	
	$result5=$conn->query($sql5);
	
	
	$x5=0;
	
	if ($result5->num_rows> 0){
		
		
		while($row= $result5->fetch_assoc()){
			
			$data5[$x5] =$row;
			$x5++;
		}
	}
	else{
		echo "<br>No such record";
	}
	
	$username_arr=array();
	$s5=0;
	
	for ($k5=0; $k5<count($data5); $k5++){
		foreach($data5[$k5] as $x5 => $x_value5) {
			
			$username_arr[$s5]=$x_value5;
			$s5++;
			
			}
	}
	
	
	



?>

  
  
    <div id="map"></div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAoQXUPPZAxR8PH1exvt_2Rmy7-VPlPyE&libraries=places">
    </script>
    <script>
      
   
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11.5,
        center: {lat: 22.301379, lng: 114.105869}
    });
	
	var name0= "<?php echo $username_arr[0] ?>";
	var name1= "<?php echo $username_arr[1] ?>";
	var name2= "<?php echo $username_arr[2] ?>";
	var name3= "<?php echo $username_arr[3] ?>";
	var name4= "<?php echo $username_arr[4] ?>";
	var name5= "<?php echo $username_arr[5] ?>";
	var name6= "<?php echo $username_arr[6] ?>";
	var name7= "<?php echo $username_arr[7] ?>";
	
	
	
	var score0= "<?php echo $score[0] ?>";
	var score1= "<?php echo $score[1] ?>";
	var score2= "<?php echo $score[2] ?>";
	var score3= "<?php echo $score[3] ?>";
	var score4= "<?php echo $score[4] ?>";
	var score5= "<?php echo $score[5] ?>";
	var score6= "<?php echo $score[6] ?>";
	var score7= "<?php echo $score[7] ?>";
	
	var lat0= "<?php echo $lati[0] ?>";
	var lat1= "<?php echo $lati[1] ?>";
	var lat2= "<?php echo $lati[2] ?>";
	var lat3= "<?php echo $lati[3] ?>";
	var lat4= "<?php echo $lati[4] ?>";
	var lat5= "<?php echo $lati[5] ?>";
	var lat6= "<?php echo $lati[6] ?>";
	var lat7= "<?php echo $lati[7] ?>";
	
	
	var lngn0= "<?php echo $lngn[0] ?>";
	var lngn1= "<?php echo $lngn[1] ?>";
	var lngn2= "<?php echo $lngn[2] ?>";
	var lngn3= "<?php echo $lngn[3] ?>";
	var lngn4= "<?php echo $lngn[4] ?>";
	var lngn5= "<?php echo $lngn[5] ?>";
	var lngn6= "<?php echo $lngn[6] ?>";
	var lngn7= "<?php echo $lngn[7] ?>";
	
	
	
    addMarker({lat: Number(lat0), lng: Number(lngn0)},name0+"<br> Address: "+score0);
	addMarker({lat: Number(lat1), lng: Number(lngn1)}, name1+"<br> Address: "+score1);
	addMarker({lat: Number(lat2), lng: Number(lngn2)}, name2+"<br> Address: "+score2);
	addMarker({lat: Number(lat3), lng: Number(lngn3)},name3+"<br> Address: "+score3);
	addMarker({lat: Number(lat4), lng: Number(lngn4)}, name4+"<br> Address: "+score4);
	addMarker({lat: Number(lat5), lng: Number(lngn5)}, name5+"<br> Address: "+score5);
	addMarker({lat: Number(lat6), lng: Number(lngn6)}, name6+"<br> Address: "+score6);
	addMarker({lat: Number(lat7), lng: Number(lngn7)}, name7+"<br> Address: "+score7);
	
	
	function addMarker(coordinate, content1){
	var marker = new google.maps.Marker({
        position: coordinate,
        map: map,
		draggable: true
    });
	
	var infoWindow = new google.maps.InfoWindow({
		content: content1
	});
	
	marker.addListener("click", function(){
		infoWindow.open(map, marker);
	});
	
	}
	
	
	
    </script>

</body>
</html>