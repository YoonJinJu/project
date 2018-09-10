<?php
    // textarea안의 내용을 html로부터 받는다.
    $request_Text   = $_GET['text'];
    $input          = $_GET['input'];

    $find_Text      = $_GET['find'];
    $change_Text    = $_GET['change'];

    $name           = $_GET['name'];

    // 배열 끊어주기
    $input = str_split($input, 1);

    /* 1. 찾아바꾸기
       str_replace() : 문자열에서 특정문자열을 찾아 다른 문자열로 치환.*/
    if($input[0] == 1) {
        $result = str_replace("$find_Text", "$change_Text", "$request_Text");
        echo $result;
    }

    /* 2. 소문자 -> 대문자
       strtoupper() : 모든 알파벳을 대문자로 바꾸는 함수. */
    if($input[0] == 2) {
        $result = strtoupper($request_Text);
        echo $result;
    }

    /* 3. 대문자 -> 소문자
       strtolower() : 모든 알파벳을 소문자로 바꾸는 함수. */
    if($input[0] == 3) {
        $result = strtolower($request_Text);
        echo $result;
    }

    /* 4. 저장
        fwrite() : 문자열을 파일에 저장. */
    if($input[0] == 4) {
        $open = fopen("C:\Users\pdu04\Desktop/$name.txt","w");
        $result = fwrite($open,$request_Text);

        fclose($open);
    }
?>