<?php

    $height = 200;
    $width  = 200;
    $im     = imageCreateTrueColor($width, $height);                    // 캔버스 생성.캔버스의 크기 설정
    $white  = imageColorAllocate($im, 255, 255, 255);    // 색상 지정하기
    $blue   = imageColorAllocate($im, 0,0,64);

    // draw on canvas
    imageFill($im, 0, 0, $blue);                                    // 캔퍼스 배경색 채우기
    imageLine($im, 0, 0, $width, $height, $white);                // 선 그리기 ImageLine(캔버스ID,시작X,시작Y,끝X,끝Y,색깔)
    imageString($im, 4, 50, 150, 'Sales', $white);       // 문자열 수평으로 그리기

    // output image
    Header('Content-type: image/png');                            // 이 파일은 image이고 png형 입니다.
    imagePng($im);                                                      // PNG이미지 파일을 브라우저 or 파일 출력

    // clean up
    imageDestroy($im);                                                  // 이미지 삭제하기
?>
