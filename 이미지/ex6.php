<?php
    // 도형 출력 (사각형)
    $height = 400;
    $width  = 400;

    $im     = ImageCreateTrueColor($width, $height);
    $pink   = ImageColorAllocate($im, 255, 192, 203);

    // ( 캔버스ID, 시작X, 시작Y, 끝X, 끝Y, 색깔 );
    Imagerectangle($im, 100, 100, 200, 200, $pink);

    Header('Content-type: image/png');
    ImagePng($im);

    ImageDestroy($im);
?>