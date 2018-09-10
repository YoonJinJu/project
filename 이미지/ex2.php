<?php
    // 캔퍼스 배경색 색칠하기
    $height = 400;
    $width  = 400;
    $im     = ImageCreateTrueColor($width, $height);                    // 캔퍼스 생성
    $pink   = ImageColorAllocate($im, 255, 192, 203);    // pink색 지정하기

    ImageFill($im, 0, 0, $pink);                                    // 캔퍼스에 배경색 설정

    // HTTP를 통해 서버에서 브라우저로 데이터를 전달할때 전달하려는 데이터의 종류를 알려주는 데이터.
    Header('Content-type: image/png');
    ImagePng($im);                                                       // PNG 이미지 파일을 출력

    ImageDestory($im);                                                   // 이미지 삭제
?>