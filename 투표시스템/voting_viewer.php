<?php
   // db_class
    class db_info {
        const host          = "localhost";
        const id            = "root";
        const passwd        = "autoset";
        const db_name       = "ycj_test";
        const table_name    = "vote";
    }

    $db_con = new mysqli(db_info::host, db_info::id, db_info::passwd, db_info::db_name);

    if($db_con->connect_errno) {
        echo "Failed to connect to MySQL: ".$conn->connect_errno;
    }

    // 투표받은 대상 받기
    $voting_man = $_POST['vote'];

    if($voting_man == null)
    {
        echo "<script>history.back();</script>";
    }
        // 개수 파악하기
        $result = $db_con->query("select max(id) from vote");
        $record_1 = $result->fetch_array();
        $id = $record_1['max(id)'];

        // 김대권일 경우.
        if ($voting_man == 'Kim') {
            $id++;
            if ($db_con->query("insert into vote values($id, '김대권', 1)")) {
            } else {
                throw new Exception('Mysqli_query_error');
            }

        }
        // 정야망일 경우.
        if ($voting_man == 'Jung') {
            $id++;
            if ($db_con->query("insert into vote values($id, '정야망', 1)")) {
            } else {
                throw new Exception('Mysqli_query_error');
            }
        }
        // 강희망일 경우.
        if ($voting_man == 'Kang') {
            $id++;
            if ($db_con->query("insert into vote values($id, '강희망', 1)")) {
                /*echo "<script>alert('투표완료')</script>";*/
            } else {
                throw new Exception('Mysqli_query_error');
            }
        }

        // -------- 각각의 득표수 파악 ---------
        // 김씨.
        $result = $db_con->query("select * from vote where name = '김대권'");
        $KimCount = $result->num_rows;
        // 정씨.
        $result = $db_con->query("select * from vote where name = '정야망'");
        $JungCount = $result->num_rows;

        // 강씨.
        $result = $db_con->query("select * from vote where name = '강희망'");
        $KangCount = $result->num_rows;

        $All_Count = $KimCount + $JungCount + $KangCount;

        // 퍼센트
        $KimPer = ceil($KimCount / $All_Count * 100);
        $JungPer = ceil($JungCount / $All_Count * 100);
        $KangPer = ceil($KangCount / $All_Count * 100);

   // 캔퍼스 그리기.
    $height = 700;
    $width  = 1000;

    $im     = imagecreatetruecolor($width,$height);
    $white  = imagecolorallocate($im, 255, 255, 255);
    $black  = imagecolorallocate($im, 0, 0, 0);
    $pink   = imagecolorallocate($im, 255, 216, 216);
    $yellow = imagecolorallocate($im, 250, 236, 197);
    $gray   = imagecolorallocate($im, 189, 189, 189);

    imagefill($im,0,0,$white);

    imagestring($im, 30, 15, 170, "Kimdegun", $black);
    ImageString($im, 30, 9, 330, "Jungyamang", $black);
    ImageString($im, 30, 9, 490, "Ganghimang", $black);

    Imageline($im, 100, 100, 100, 600, $black);
    Imageline($im, 100,600,950, 600, $black);

    ImageFilledRectangle($im, 110, 150, 110+$KimCount*9, 220, $pink);
    ImageFilledRectangle($im, 110, 310, 110+$JungCount*9, 380, $yellow);
    ImageFilledRectangle($im, 110, 470, 110+$KangCount*9, 540, $gray);

    ImageString($im, 30, 150, 175, "$KimPer%", $black);
    ImageString($im, 30, 150, 335, "$JungPer%", $black);
    ImageString($im, 30, 150, 495, "$KangPer%", $black);

    Header('Content-type: image/jpeg');                    // HTTP로 전달하려는 데이터의 종류를 알려줌.
    Imagejpeg($im); // PNG 파일을 출력.


    // 자기 아이디 번호 방번호 내용
    // 발표 DB스키마 어떤식으로 긁어올지. -> 알고리즘 발표시간 5분이내. 이번주 일요일까지 만들어서 작성.
    // 날라가는 데이터가무엇인지.
    // join. 나가기 => 나간다는 메세지. DB스키마와 알고리즘 전체 페이지 구조
?>