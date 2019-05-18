<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

<title>Welcome to Rabbit Banquet</title>

<script>
function loadImg(number){
	var link = "store_images.php?id="+ number;
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("imgDiv").innerHTML= xmlhttp.responseText;
		
		}
	};
	
	xmlhttp.open("GET", link, true);
	xmlhttp.send();
	setTimeout("loadImg("+(number+1)+")", 2000);
}
</script>

</head>

<body onload= "loadImg(0)">

		
<div class="wrapper row1">
<div id="header" class="clear">
<div class="fl_left">
<h1><a href="index.php">RabbitBanquet</a></h1>
<p>Assistance for banquet management.</p>
</div>
 <?php

	session_start();
		echo "<form action=\"login.php\" method=\"post\" id=\"login\">";
		echo "<input type=\"password\" placeholder=\"Password\" name=\"password\" />";
		echo "<input type=\"text\" placeholder=\"Username\" name=\"username\" />";
		echo "<div id=\"forgot\"><a href=\"register.php\">Register</a> or <a href=\"#\">Forgot Your Password?</a></div>";
		echo"<br></br>";
		echo "<button type=\"submit\" name=\"Login\" id=\"Login\" value=\"Login\" class=\"button-sty\">Login</button>";
		echo "</form>";
	
	

	?>

</div>
</div>


<div class="menuBar">
<a href="about.php">About</a> &middot;
<a href="register_banquet.php">Register for a Banquet</a> &middot;
<a href="contact.php">Contact</a> 
</div>

<div id= "imgDiv">

</div>


</body>
</html>