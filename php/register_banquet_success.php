<!DOCTYPE html>
	<html>
		<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Successful Register Banquet--Rabbit Banquet</title>
		
		</head>

		<body bgcolor="FFFFFF">		
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
                        echo "<form action=\"index.php\" method=\"post\" id=\"login\">";
						echo "<input type=\"password\" placeholder=\"Password\" name=\"password\" />";
						echo "<input type=\"text\" placeholder=\"Username\" name=\"username\" />";
						echo "<div id=\"forgot\"><a href=\"register.php\">Register</a> or <a href=\"#\">Forgot Your Password?</a></div>";
						echo "<button type=\"submit\" id=\"btn\" value=\"Login\" class=\"button-sty\">Login</button>";
						echo "</form>";
                    }
					
						//---------------------------------
	

if (isset($_POST["Login"])){
	require "config.php";
	$username=$_POST["username"];
	$pass=$_POST["pass"];
	
	
	
	if (empty($username) || empty($pass)){
		echo "<span style='color:white;float:right;'>Username and Password are required!!";
		}
		
	if(!empty($_POST["username"]) && !empty($_POST["pass"])  ){
		$sql="SELECT * FROM admin where username='$_POST[username]' AND password='$_POST[pass]'";
		$result=$conn->query($sql);
		while($row= $result->fetch_assoc()){
			
			
		if ($result->num_rows> 0){
			
			$_SESSION["username"] = $username;
			
			
			
				header("Location: index_logged_in.php");
				//if user is admin redirect to admin page
			}
			
			
			
		
		else{
			echo "Incorrect Username or Password...";
		}
		//if ($result->num_rows<0){
			//echo"no";
			//echo "Incorrect Username or Password...";
			
			//}
		}
		//echo "Incorrect Username or Password...";
		
	}	
	
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
<h1>Success</h1>
A validation E-mail will be sent to your registered E-mail.
The inputted personal information and banquet details will be included in the E-mail.
<p>Please check those information carefully, if any incorrect information, please notify us via adminBanquet1@gmail.com.<p>
</div>

</body>
</html>