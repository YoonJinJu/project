<?php
    $value = $_GET['expression'];

    $value .= "=";
    // 문자열 길이
    $count = 0;

    // 배열
    $numArray = [];
    $operArray = [];

    // 문자열을 담아줄 예비 공강
    $temp = '';

    // 총합
    $Result = 0;

    // 문자열 길이 구하기.
    for($i = 0 ; $i < strlen($value)  ; $i++) {
        if($value[$i] == "+" || $value[$i] == "-" || $value[$i] == "*" || $value[$i] == "/" || $value[$i] == "=")
        {
            array_push($operArray,$value[$i]);
            array_push($numArray,$temp);
            $temp = '';
        }
        else
        {
            $temp .= $value[$i];
        }
    }

    $Result = array_shift($numArray);

    // 연산지를 기준으로 계산하는 for문
    for($i = 0; $i < sizeof($operArray); $i++) {
        switch ($operArray[$i]) {
            case "+":
                $Result += array_shift($numArray);
                break;

            case "-":
                $Result -= array_shift($numArray);
                break;

            case "*":
                $Result = $Result * array_shift($numArray);
                break;

            case "/":
                $Result = $Result / array_shift($numArray);
                break;
        }
    }
echo $Result;
?>