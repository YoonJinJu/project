<?php
    // 가로, 세로, 범위(시작,끝), 3의 배수
    $width_size     = $_GET['width'];
    $height_size    = $_GET['height'];
    $start_Num      = $_GET['start'];
    $end_Num        = $_GET['end'];
    $three_Mult     = $_GET['ok'];

    // 가로 * 세로 => 난수 생성 범위 제한.
    $Max_Count = $width_size * $height_size;
    // 범위 개수 파악.
    $Min_Count  = ($end_Num - $start_Num) + 1;

    // 범위 예외 처리.
    if($Max_Count != $Min_Count)
    {
        echo '<script> alert("!-- 범위오류 --! 다시 입력해주세요.")</script>';
        echo '<script> document.location.href = "random.html"; </script>';
    }
    else {
        // 입력한 개수만큼 table을 만들어 난수를 생성하여 넣기
        // $randomNum = mt_rand(최소값, 최대값)
        $Random_Num = array();

        for($i = 0; $i < $Max_Count; $i++) {
            $Random_Num[$i] = mt_rand($start_Num, $end_Num);
            // 중복값 제거 for문.
            for($j = 0; $j < $i; $j++)
            {
                if($Random_Num[$i] == $Random_Num[$j])
                {
                    $Random_Num[$i--];
                    break;
                }
            }
        }

        // table 만들기
        // 2차원 배열안에 난수 넣기
        $Set_Num[][] = " ";
        // 1차원 배열 count
        $count = 0;
        for($i = 0; $i < $height_size; $i++)
        {
            for($j = 0; $j < $width_size; $j++)
            {
                $Set_Num[$i][$j] = $Random_Num[$count];
                $count++;
            }
        }

        echo "<table border = 1px>";

        // 세로
        for($i = 0; $i < $height_size; $i++)
        {
            echo "<tr>";
            // 가로
            for($j = 0; $j < $width_size; $j++) {
                //난수값 넣는 for
                $Setting = $Set_Num[$i][$j];
                if ($three_Mult == true) {
                    if ($Setting % 3 == 0) {
                        echo "<td style = background-color:#FAECC5>&nbsp$Setting&nbsp</td>";
                    }
                    else
                    {
                        echo "<td>&nbsp$Setting&nbsp</td>";
                    }
                }
                else{
                    echo "<td>&nbsp$Setting&nbsp</td>";
                }
            }
            echo "</tr>";
        }
        // html 파일로 되돌아가는 버튼 만들기.
        echo "<input type='button' value='되돌아가기' onClick=\"location.href='random.html'\">";
    }
?>

