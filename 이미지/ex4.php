<?php
    // 문자 출력
    $height = 400;
    $width  = 400;

    $im     = ImageCreateTrueColor($width, $height);                    // 캔퍼스 생성
    $pink   = ImageColorAllocate($im, 255, 192, 203);    // 색깔 설정

    Imagestring($im, 20, 200, 200, "test", $pink);       // (캔퍼스ID, 폰트사이즈, X, Y, 내용, 색깔);

    Header('Content-type: image/png');                            // HTTP 전달하는데이터의 종류 알려주기.
    ImagePng($im);

    ImageDestory($im);
?>