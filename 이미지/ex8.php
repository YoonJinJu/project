<?php
    // 이미지 필터링
    $height = 1000;
    $width  = 1000;

    $image_name = "he.JPG";
    $im         = imagecreatefromjpeg($image_name);

    // --- 필터링's ---
    //imagefilter($im, IMG_FILTER_GRAYSCALE);
    //imagefilter($im, IMG_FILTER_EMBOSS);
    imagefilter($im, IMG_FILTER_BRIGHTNESS, 90);

    Header('Content-type: image/JPG');
    ImagePng($im);

    ImageDestroy($im);
?>