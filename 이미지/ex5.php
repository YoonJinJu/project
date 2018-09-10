<?php
    // 문자 출력(2)
    $height = 400;
    $width  = 400;

    $im     = ImageCreateTrueColor($width, $height);
    $pink   = ImageColorAllocate($im, 255, 192, 203);

    // (캔퍼스 ID, 폰트 사이즈, 출력각도, X , Y, 색깔, 폰트, 내용);
    Imagettftext($im, 20, 90, 100, 100, $pink, './arial.ttf', "afdsfdsf");

    Header('Content-type: image/png');
    ImagePng($im);

    ImageDestroy($im);
?>