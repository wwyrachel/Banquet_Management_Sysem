<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Register--Rabbit Banquet</title>

</head>

<body>

	
		
<div class="wrapper row1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index.php">RabbitBanquet</a></h1>
      <p>Assistance for Banquet Management.</p>
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

<div class="whiteSpace">
</div>


<h1>Register</h1>
Enter your personal informational below. Noted that your application need to be approved by the system administrator<br></br>
<?php

if (isset($_POST["BRegister"])){
	require "config.php";
	$username=$_POST["username"];
	$pass=$_POST["pass1"];
	$pass1=$_POST["pass1"];
	$name= $_POST["name"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	

	if ((!empty($pass) || empty($pass1)) AND $pass != $pass1){
	echo "Password and Confirmed Password are not the same!!<br>";
	}
	else{
	if (empty($username) || empty($pass)|| empty($name)){
	echo "Username, Password and Name are required!!";
	}

	else{
	echo"Your application has been submitted, system administrator will notify you through email if it is approved";
	}
	}


}
?>

<div>
<form method="POST">
<label>Username:</label>
<input type="text" id="username" name="username">
<br></br>
<label>Name:</label>
<input type="text" id="name" name="name">
<br></br>
<label>Phone:</label>
<input type="text" id="phone" name="phone">
<br></br>
<label>E-mail:</label>
<input type="email" id="email" name="email">
<br></br>
<label>Password:</label>
<input type="password" id="pass" name="pass">
<br></br>
<label>Confirned Password:</label>
<input type="password" id="pass1" name="pass1">
<br></br>



<input type="submit" id="register_btn" name="BRegister" value="Register" class="button-sty">
</form>

</div>



</body>
</html>