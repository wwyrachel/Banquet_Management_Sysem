<!DOCTYPE html>
	<html>
		<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Contact--Rabbit Banquet</title>
		
		</head>

				
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

<div style="display:inline-block; float:left; width:100%; padding:10px 0 10px 10px;">
<h1>Contact</h1>
<u>Phone</u>: 9234 5678<br>
<u>24-hour hotline</u>: 9234 4321<br>
<u>Email</u>: 16058981d@connect.polyu.hk<br>
<u>Address</u>: The Hong Kong Polytechnic University,<br>Hung Hom, Kowloon, Hong Kong<br>
<u>Opening Hours</u>: Monday-Saturday: 10:00am – 9:00pm<br>
		Sunday & Public Holidays: 1:00pm – 8:00pm <p>


</div>
 <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 22.30348, lng: 114.17786};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr6kFEohhC3zme5d4JSPIh7yihPYCTr-A&callback=initMap">
    </script>
<br><strong>~~~~Feel Free to Contact Us!!!~~~~</br></strong>
</body>
</html>