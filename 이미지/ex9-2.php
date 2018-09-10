<?php
    $height = 400;
    $width  = 400;

    $im     = Imagecreatefromjpeg("he.JPG");

    Imagefilter($im, IMG_FILTER_GRAYSCALE);

    Header('Content-type: image/JPG');
    Imagepng($im);

    Imagedestroy($im);
?>