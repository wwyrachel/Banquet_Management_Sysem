<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Create Banquet--Rabbit Banquet</title>

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

<div class="whiteSpace">
</div>
<h1>Create Banquet</h1>	

<?php 


if (isset($_POST["Bcreate"])){
	require "config.php";
	$name=$_POST["name"];
	$date=$_POST["date"];
	$time=$_POST["time"];
	$searchBox=$_POST["searchBox"];
	$location=$_POST["location"];
	$email=$_POST["email"];
	$fstaff=$_POST["fstaff"];
	$lstaff=$_POST["lstaff"];
	$locatLat=$_POST["lat"];
	$locatLng=$_POST["lng"];
	
	
	
	if (empty($name) || empty($date)|| empty($searchBox)){
		echo "Event Name, Date and Address are required!!";
		}
		
	else{
		//$sql="INSERT INTO 'banquet' ('email', 'banquetName','date', 'time', 'address', 'location', 'staffName' ) VALUES ('$email', '$name', '$date', '$time', '$address', '$location', '$staff')";
		//insert the new record into the activities table in the database
		//$sql="INSERT INTO `banquet`(`email`, `banquetName`, `date`, `time`, `address`, `location`, `staffName`, `locatLat`, `locatLng`) VALUES ('$email','$name','$date','$time','$address','$location','$staff','$lat', '$lng')";
		$sql="INSERT INTO `banquet`(`email`, `banquetName`, `date`, `time`, `address`, `location`, `first_staffN`, `last_staffN`, `locatLat`, `locatLng`) VALUES ('$email','$name','$date','$time','$searchBox','$location','$fstaff', '$lstaff', '$locatLat', '$locatLng')";
		if($conn->query($sql)==TRUE){
			echo"Successfully created!";
			}
			else{
				echo"Error!";
			}
		}
	
	
	
}
?>


<div>
<form name="myform" method="POST">
<br>
<label>Banquet Name:</label>
<input type="text" id="name" name="name">
<br></br>
<label>Date of Banquet:</label>
<input type="date" placeholder="YYYY-MM-DD" id="date" name="date">
<br></br>
<label>Time of Banquet:</label>
<input type="time" id="time" name="time">
<br></br>
<label>Email:</label>
<input type="email" id="email" name="email">
<br></br>
<label>Contact Staff:</label>
<input type="text" id="fstaff" name="fstaff" placeholder="First Name">
<input type="text" id="lstaff" name="lstaff" placeholder="Last Name">
<br></br>
<label>Location:</label>
<input type="text" id="location" name="location">
<br></br>

<label>Address:</label>
<input type="text" id="searchBox" name="searchBox" size="50px">
<br>
<input type= "hidden" id="lat" name="lat" value="">
<br>
<input type= "hidden" id="lng" name="lng" value="">


<div id="map"></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAoQXUPPZAxR8PH1exvt_2Rmy7-VPlPyE&language=en&libraries=places">
    </script>	
<script>
  var uluru = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map,
		draggable: true
    });
	
	var search = new google.maps.places.SearchBox(document.getElementById("searchBox"));
		
	google.maps.event.addListener(search, "places_changed", function(){
	    var newPlace= search.getPlaces();
		
		var bounds = new google.maps.LatLngBounds();
		var place, n, locatLat, locatLng;
		
		
		for (n=0; place=newPlace[n]; n++){
		   console.log(n);
		   bounds.extend(place.geometry.location);
		   marker.setPosition(place.geometry.location);
		   console.log("lat: "+place.geometry.location.lat()+"\nlng: "+place.geometry.location.lng());
		   document.myform.lat.value= place.geometry.location.lat();
		   document.myform.lng.value= place.geometry.location.lng();
		   
		}
		
		
		//bounds.extend(newPlace[0].geometry.location);
		//marker.setPosition(newPlace[0].geometry.location);
		
		
		map.fitBounds(bounds);
		map.setZoom(13);
		
		
		
	});	
      
</script>

<input type="submit" id="create_btn" name="Bcreate" value="Create" class="button-sty">
</form>

</div>



</body>
</html>