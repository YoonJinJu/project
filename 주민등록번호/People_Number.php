<?php
    // html로부터 주민등록번호를 받는다.
    $peopleNumber = $_GET['number'];

    // 숫자를 담을 배열
    $Number = array();

    // 합계 변수 & 결과
    $Sum        = 0;
    $result     = 0;

    // 1. 주민등록번호 출력
    echo $peopleNumber;

    // peopleNumber길이 만큼 돌면서 숫자배열안에 숫자들을 넣어준다.
    for($i = 0; $i < strlen($peopleNumber); $i++) {
        if($peopleNumber[$i] == "-")
        {
            continue;
        }
        else if($peopleNumber[$i] >= 0 && $peopleNumber[$i] <= 9)
        {
            array_push($Number, $peopleNumber[$i]);
        }
    }

    // 2. 성별 출력.
    if($Number[6] == "1" || $Number[6] == "3")
    {
        echo " 남자 "."<br>";
    }
    else if($Number[6] == "2" || $Number[6] == "4")
    {
        echo " 여자"."<br>";
    }
    else
    {
        echo "성별을 알 수 없는 주민등록번호입니다."."<br>";
    }

    // 3. 유효 주민등록번호 검사
    // 유효성 검사 식.( 마지막 자리수 빼고 for문이 돈다.)
    for($i = 0, $mult_count = 2; $i < 12; $i++, $mult_count++)
        {
            if($mult_count == 10)
            {
                $mult_count = 2;
        }

        $Sum += $Number[$i] * $mult_count."<br>";
    }

    $result = 11 - ( $Sum % 11 );
        if($result >= 10)
        {
            $result = $result - 10;
        }

    if($result == $Number[12]) {
        echo "유효한 주민등록번호 입니다." . "<br>";

        // 4. 생년월일 출력
        $year = date("Y");
        if ($Number[0] . $Number[1] > $year - 2000) {
            echo "19" . $Number[0] . $Number[1] . "년 ";

            if ($Number[2] == 0) {
                echo $Number[3] . "월 ";
            } else {
                echo $Number[2] . $Number[3] . "월 ";
            }

            if ($Number[4] == 0) {
                echo $Number[5] . "일입니다." . "<br>";
            } else {
                echo $Number[4] . $Number[5] . "일입니다." . "<br>";
            }
        } else {
            echo "20" . $Number[0] . $Number[1] . "년 ";

            if ($Number[2] == 0) {
                echo $Number[3] . "월 ";
            } else {
                echo $Number[2] . $Number[3] . "월 ";
            }

            if ($Number[4] == 0) {
                echo $Number[5] . "일입니다." . "<br>";
            } else {
                echo $Number[4] . $Number[5] . "일입니다." . "<br>";
            }
        }
        // 5. 생일 D-Day 검사
        $Year   = date("Y");
        $Month  = date("m");
        $Day    = date("d");

        $nDate = date("Y-m-d",time());

        $valDate = $Year.'-'.$Number[2].$Number[3].'-'.$Number[4].$Number[5];

        $leftDate = intval((strtotime($nDate)-strtotime($valDate)) / 86400);

        echo "생일 D".$leftDate." 남았습니다.";

    }
    else{
        echo "유효하지 않은 주민등록번호 입니다."."<br>";
    }


?>