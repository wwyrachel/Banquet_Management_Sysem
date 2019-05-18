<html>
<body>

<?php
$img= array(
	"http://www4.comp.polyu.edu.hk/~16073421d/banquet_img/banquet_1.jpg",
	"http://www4.comp.polyu.edu.hk/~16073421d/banquet_img/banquet_2.jpg",
	"http://www4.comp.polyu.edu.hk/~16073421d/banquet_img/banquet_3.jpg",
	"http://www4.comp.polyu.edu.hk/~16073421d/banquet_img/banquet_4.jpg"		
	);
$id=0;

if (isset($_GET["id"])){
	$id = $_GET["id"] %4;
	echo "<img width = 1000px height= 500px src=".$img[$id]."><br/>";
}


?>


</body>
</html>