<html>
<body>
<?php
  $image = ImageCreate(300, 270);
  $white = ImageColorAllocate($image, 255, 255, 255);
  $blue = ImageColorAllocate($image, 0, 0, 255);
  ImageFill($image, 0, 0, $white);
  ImageFilledArc($image, 160, 150, 150, 150, 0, 360,
    $blue, IMG_ARC_PIE);
  ImagePng($image, "circle.png");
  ImageDestroy($image);
?>
<img src="circle.png" border=0>
</body>
</html>