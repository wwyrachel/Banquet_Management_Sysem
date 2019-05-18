<html>
<body>
<?php

$im = imagecreatetruecolor(250, 100);
$green = imagecolorallocate($im, 51, 255, 51);
$white = imagecolorallocate($im, 255, 255, 255);

// Draw a white rectangle
imagefilledrectangle($im, 4, 4, 246, 96, $green);

// Save the image
imagepng($im, './rectangle.png');
imagedestroy($im);
?>
<img src="rectangle.png" border=0>
</body>
</html>