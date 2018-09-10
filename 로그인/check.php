<?php
    // DB에 사용자 추가.
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "autoset");
    define("DB_NAME", "ycj_test");
    define("TABLE_NAME", "login");
    // id pass name year level
    // DB 연결
    $db_con  = mysqli_connect(HOST,USER,PASSWORD);

    // DB 선택
    $db_select = mysqli_select_db($db_con, DB_NAME);

    // 사용자를 추가하는 명령어 실행
    $query = "insert into ".TABLE_NAME." values('pdu04061','wink1027');";

    // 명령문 실행
    $db_result = mysqli_query($db_con,$query);

    $query = "select * from ".TABLE_NAME;

    $db_result = mysqli_query($db_con,$query);

    $db_array   = mysqli_fetch_array($db_result);

    $ID         = $_GET['id'];
    $PASSWORD   = $_GET['password'];
    // result가 1이면 true, 0이면 false
    $result     = 'true';

    // ID & PASSWORD 검사
    // array 자르기.
    $db_id          = str_split($db_array[id],1);
    $db_password    = str_split($db_array[password],1);
    $input_id       = str_split($ID,1);
    $input_password = str_split($PASSWORD,1);

    // id / password 길이
    $db_id_length          = strlen($db_array[id]);
    $db_password_length    = strlen($db_array[password]);
    $input_id_length       = strlen($ID);
    $input_password_length = strlen($PASSWORD);

    // 1. 길이비교.
    if($db_id_length == $input_id_length && $db_password_length == $input_password_length){
        // 2. ID 비교
        for($i = 0; $i < $db_id_length; $i++)
        {
            if($db_id[$i] != $input_id[$i])
            {
                $result = 'false';
            }
        }

        // 3. PASSWORD 비교
        for($i = 0; $i < $db_password_length; $i++)
        {
            if($db_password[$i] != $input_password[$i])
            {
                $result = 'false';
            }
        }
    }
    else {
        $result = 'false';
    }

    if($result == 'true')
    {
        session_start();
        $_SESSION['id'] = $ID;
        $_SESSION['password'] = $PASSWORD;
        echo "<B>성공적으로 로그인 하였습니다.</B>"."<br>"."<br>";
        echo "<form action='result.php'><input type='submit' value='회원정보보기.'></form>";
    }
    else {
        echo "<B>로그인에 실패하였습니다.</B>"."<br>"."<br>";
        echo "<form action='main.php'><input type='submit' value='다시입력하기기.'></form>";
    }
?>