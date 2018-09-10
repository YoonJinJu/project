<?php
    // 도형 출력 ( 다각형 )
    $height = 400;
    $width  = 400;

    $im     = ImageCreateTrueColor($width, $height);
    $pink   = imageColorAllocate($im, 255, 192, 203);

    // (캔버스ID, 좌표값 배열, 꼭지점 개수, 색깔);
    Imagepolygon($im, array(250, 0, 350, 100, 350, 200, 150, 200, 150, 100), 5, $pink);
                          // x , y , x ,  y ,  x ,  y ,  x ,  y ,  x ,  y  => 5개 좌표
    Header('Content-type: image/png');
    Imagepng($im);

    ImageDestroy($im);
?>