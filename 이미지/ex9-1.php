<?php
    $height = 400;
    $width  = 400;

    $im     = Imagecreatefromjpeg("he.JPG");

    Header('Content-type: image/JPG');
    Imagepng($im);

    Imagedestroy($im);
?>