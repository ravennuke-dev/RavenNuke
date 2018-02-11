<?php
function LoadPNG($imgname)
{
    $im = @imagecreatefrompng($imgname); /* Attempt to open */
    if (!$im) { /* See if it failed */
        $im  = imagecreatetruecolor(150, 30); /* Create a blank image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
    }
    return $im;
}
#header("Content-Type: image/png");
#$img = LoadPNG("users.png");
#imagepng($img);
  $cnbyaversion = '4.4.2';
	// menelaos: dynamically insert the version number in the admin config panel image Copyright (c) 2004 :-)
header("Content-type: image/png");
#	$icon		= "images/admin/users.png";
$icon		= "users.png";
$image = @imagecreatefrompng($icon);
#$text_color	= imagecolorallocate($image, 0, 0, 0);
#	imagestring ($image, 1, 7, 38, $cnbyaversion, $text_color);
#imagepng($image);
imagepng($image, '', 7);
#	imagedestroy($image);
?>
