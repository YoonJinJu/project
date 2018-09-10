<?php
    $One_Num = $_GET['one_Num'];
    $Two_Num = $_GET['two_Num'];
    $Check_Num = $_GET['check'];

    // 정수 두개를 입력받아 '1' a ~ z 이고 '2' A ~ Z
    // 세로 다중 행으로 출력하세요.
    // 입력 받은 정수가 1 or 2아니면 에러 메세지 출력.
    function one()
    {
        // 외부 변수 사용하기위한 global
        global $One_Num, $Two_Num;

        if($One_Num != 1 && $One_Num != 2)
        {
            echo "에러입니다. 첫번째 숫자는 1 or 2 입력해주세요"."<br>";
            echo "뒤로가기를 눌러서 다시 입력하세요.";
        }

        // a
        if($One_Num == 1){
            // 97 을 a(아스키코드)로 바꾸는 chr()함수 사용.
            for($i = 97; $i <= 122; $i++){
                for($line = 1; $line <= $Two_Num; $line++) {
                    echo chr($i);
                }echo '<br>';
            }
        }
        // A
        else if($One_Num == 2)
        {
            // 65 -> A(아스키코드)
            for($i = 65; $i <= 90; $i++){
                for($line = 1; $line <= $Two_Num; $line++) {
                    echo chr($i);
                }
                echo '<br>';
            }
        }
    }

    function two()
    {
        // 직각 삼각형을 만드는 for문.
        for ($line = 0; $line < 26; $line++) {
            for ($i = 65; $i <= 65 + $line; $i++) {
                echo chr($i);
            }echo "<br>";
        }

    }

    function three()
    {
        // 반대 직각 삼각형을 만드는 for문.
        for ($line = 0; $line < 26; $line++) {
            // 공백
            for($blank = 1; $blank <= $line; $blank++)
            {
                echo '&nbsp';
            }
            for ($i = 65; $i <= 90-$line; $i++) {
                echo chr($i);
            }echo "<br>";
        }
    }

    function four()
    {
        // 나비넥타이 반대 삼각형 만드는 for문.
        for ($line = 0; $line < 26; $line++) {
            for($i = 65; $i <= 65 + $line; $i++) {
                echo chr($i);
            }
            echo "<br>";
        }
        for($line = 1; $line < 26; $line++){
            for($i = 65; $i <= 90 - $line; $i++)
            {
                echo chr($i);
            }
            echo "<br>";
        }
    }

    function five()
    {
        for ($line = 0; $line < 26; $line++) {
            // 나비 넥타이 왼쪽 위 삼각형.
            for($i = 65; $i <= 65 + $line; $i++) {
                echo chr($i);
            }
            // 공백
            for($i = 26 - $line; $i > 1; $i--) {
                echo "&nbsp";
            }
            for($i = 26 - $line; $i > 1; $i--) {
                echo "&nbsp";
            }
            // 나비 넥타이 오른쪽 위 삼각형.
            for($i = 65 + $line; $i >= 65; $i--) {
                echo chr($i);
            }
            echo "<br>";
        }
        for($line = 1; $line < 26; $line++){
            // 나비 넥타이 왼쪽 아래 삼각형.
            for($i = 65; $i <= 90 - $line; $i++)
            {
                echo chr($i);
            }
            // 공백
            for($i = 1 ; $i <= $line ; $i++) {
                echo "&nbsp";
            }
            for($i = 1 ; $i <= $line ; $i++) {
                echo "&nbsp";
            }
            // 나비 넥타이 오른쪽 아래 삼각형.
            for($i = 90 -($line); $i >= 65; $i--) {
                echo chr($i);
            }
            echo "<br>";
        }
    }

    function six()
    {
        // 속이 빈 나비넥타이 for문.
        for ($line = 0; $line < 26; $line++) {
            // 나비 넥타이 왼쪽 위 삼각형.
            for($i = 65; $i <= 65 + $line; $i++) {
               if($i == 65 ||$line + 65 == $i || $line == 25)
               {
                   echo chr($i);
               }
               else {
                   echo "&nbsp";
               }
            }
            // 공백
            for($i = 26 - $line; $i > 1; $i--) {
                echo "&nbsp";
            }
            for($i = 26 - $line; $i > 1; $i--) {
                echo "&nbsp";
            }
            // 나비 넥타이 오른쪽 위 삼각형.
            for($i = 65 + $line; $i >= 65; $i--) {
                if($i == 65 ||$line + 65 == $i || $line == 25)
                {
                    echo chr($i);
                }
                else {
                    echo "&nbsp";
                }
            }
            echo "<br>";
        }
        for($line = 1; $line < 26; $line++){
            // 나비 넥타이 왼쪽 아래 삼각형.
            for($i = 65; $i <= 90 - $line; $i++)
            {
                if($i == 65 || $i == 90 - $line)
                {
                    echo chr($i);
                }
                else {
                    echo "&nbsp";
                }
            }
            // 공백
            for($i = 1 ; $i <= $line ; $i++) {
                echo "&nbsp";
            }
            for($i = 1 ; $i <= $line ; $i++) {
                echo "&nbsp";
            }
            // 나비 넥타이 오른쪽 아래 삼각형.
            for($i = 90 -($line); $i >= 65; $i--) {
                if($i == 65 || $i == 90 - $line)
                {
                    echo chr($i);
                }
                else {
                    echo "&nbsp";
                }
            }
            echo "<br>";
        }

    }
    switch ($Check_Num)
    {
        case 'one':
            one();
            break;
        case 'two':
            two();
            break;
        case 'three':
            three();
            break;
        case 'four':
            four();
            break;
        case 'five':
            five();
            break;
        case 'six':
            six();
            break;
    }
?>
<script>
    setInterval( function retrun() {
        document.location.href = "Number_input.html";
    },10000)
</script>

