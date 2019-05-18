<html>
<body>
<?php

$im = imagecreatetruecolor(250, 130);
$yellow = imagecolorallocate($im, 255, 255, 51);
$white= imagecolorallocate($im, 255, 255, 255);
ImageFill($im, 0, 0, $white);
// Draw a white rectangle
imagefilledellipse($im, 110, 50, 200, 90, $yellow);

// Save the image
imagepng($im, './oval.png');
imagedestroy($im);
?>
<img src="oval.png" border=0>
</body>
</html>