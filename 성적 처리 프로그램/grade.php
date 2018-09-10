<?php
    // 방문자수 파악하는 php

    if(!file_exists("count.txt")) {
        $fp = fopen("count.txt","w+");
        fclose($fp);
    }
    $count = file("count.txt");
    $count = chop($count[0]);
    if(!$_COOKIE["ip"]) {
        $count++;
        $fp = fopen("count.txt","w");
        fwrite($fp,"$count");
        fclose($fp);
        setcookie("ip",$REMOTE_ADDR);
}
?>

<html>
<head>
    <STYLE>
        .table {
            border : 2px solid darkgrey;
            width: 700px;
            text-align: center;
        }
        #B {
            margin-left: 20%;
        }
    </STYLE>
</head>
<h2><B>[ 성적 처리 프로그램 예제 ]</B></h2>
<B>< 학생 성적 입력하기 ></B> <B id = "B"><?php echo "전체방문자 : ".$count."명"; ?></B>
<form action="grade.php" method="GET">
    <table style = "border : 2px solid darkgrey; height: 40px; text-align: center">
        <tr>
            <td style = "background-color: cornsilk">
                &nbsp이름:<input type = "text" name = "name" style="width: 50px"/>
                국어:<input type = "text" name = "kor" style="width: 50px"/>
                영어:<input type = "text" name = "eng" style="width: 50px"/>
                수학:<input type = "text" name = "mat" style="width: 50px"/>
                <input type = "submit" value = "입력" style="width: 50px"/>&nbsp
            </td>
            <td style="background-color: antiquewhite">
                &nbsp<input type = "submit" name = "mode" value = "1.성적순 정렬" />
                <input type = "submit" name = "mode" value = "2.성적역순 정렬" />&nbsp
            </td>
        </tr>
    </table>
    <br>
    <table class="table">
        <tr>
            <td style="background-color: bisque; width: 100px"> 번호 </td>
            <td style="background-color: bisque; width: 100px"> 이름 </td>
            <td style="background-color: bisque; width: 100px"> 국어 </td>
            <td style="background-color: bisque; width: 100px"> 영어 </td>
            <td style="background-color: bisque; width: 100px"> 수학 </td>
            <td style="background-color: bisque; width: 100px"> 합계 </td>
            <td style="background-color: bisque; width: 100px"> 평균 </td>
            <td style="background-color: bisque; width: 100px">&nbsp</td>
        </tr>
    </table>
</form>
</body>
</html>



<?php
    // 성적 처리 DB table 생성.
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "autoset");
    define("DB_NAME", "ycj_test");
    define("TABLE_NAME", "students");

    // 사용자에게 입력받은 값.
    $NAME = $_GET['name'];
    $KOR = $_GET['kor'];
    $ENG = $_GET['eng'];
    $MAT = $_GET['mat'];
    $SUM = $KOR + $ENG + $MAT ;
    $AVG = round($SUM / 3,1);

    //DB에 연결.
    $db_con = mysqli_connect(HOST,USER,PASSWORD);

    // DB를 선택.
    mysqli_select_db($db_con, DB_NAME);

    $count_query = "select max(std_id) from ".TABLE_NAME;
    $count_1 = mysqli_query($db_con, $count_query);
    $count_2 = mysqli_fetch_array($count_1)['max(std_id)'];

    // DB에 입력값을 넣기.
    if($NAME != null) {
        if($count_2 == null)
        {
            $count_2 = 1;
        }
        else {
            $count_2++;
        }
        $query = "insert into " . TABLE_NAME . " values($count_2,'$NAME','$KOR','$ENG','$MAT','$SUM','$AVG');";
    }

    mysqli_query($db_con, $query);
?>
<?php
    $MODE = $_GET['mode'];
    $input = str_split($MODE, 1);
    $Delete = $_GET['delete'];

    // 정렬
    if($input[0] == '1')
    {
        $mode_sql = "select * from ".TABLE_NAME." order by sum desc";
    }
    else if($input[0] == '2') {
        $mode_sql = "select * from ".TABLE_NAME." order by sum";
    }
    else {
        $mode_sql = "select * from ".TABLE_NAME;
    }

    $result = mysqli_query($db_con,$mode_sql);

    // 삭제
    if($Delete != null)
    {
        $mode_sql = "delete from ".TABLE_NAME." where std_id=".$Delete;
        $result = mysqli_query($db_con,$mode_sql);
        $mode_sql = "select * from ".TABLE_NAME;
        $result = mysqli_query($db_con,$mode_sql);
    }

    while($row = mysqli_fetch_array($result))
    {
        echo("<table class='table'>");
        echo("<tr>");
        echo("<td style='width: 100px'>$row[std_id]</td>");
        echo("<td style='width: 100px'>$row[name]</td>");
        echo("<td style='width: 100px'>$row[kor]</td>");
        echo("<td style='width: 100px'>$row[eng]</td>");
        echo("<td style='width: 100px'>$row[math]</td>");
        echo("<td style='width: 100px'>$row[sum]</td>");
        echo("<td style='width: 100px'>$row[ayg]</td>");
        echo("<td style='width: 100px'><a href='http://127.0.0.1/grade.php?delete=$row[std_id]'>삭제</a></td>");
        echo("</tr>");
    }
    mysqli_close();
?>