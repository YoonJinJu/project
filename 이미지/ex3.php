<?php
    // 선 긋기
    $height = 400;
    $width  = 400;

    $im     = ImageCreateTrueColor($width, $height);            // 캔퍼스 생성.
    $pink  = ImageColorAllocate($im, 255, 192, 203);  // white 색.

    for($i = 1; $i <= 400; $i+= 10)                             // i가 10씩 증가하면서 40개의 시작점 생성
    {
        ImageLine($im, $i, 0, 0, $i, $pink);
    }

    Header('Content-type: image/png');                    // HTTP로 전달하려는 데이터의 종류를 알려줌.
    ImagePng($im);                                              // PNG 파일을 출력.

    ImageDestroy($im);                                          // 이미지 삭제.
?>