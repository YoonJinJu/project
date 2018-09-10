<?php
    $id             = $_GET['id'];
    $re             = $_GET['re'];
    $userid         = $_GET['userid'];
    $userpassword   = $_GET['userpassword'];
    $username       = $_GET['username'];
    $classification = $_GET['classification'];
    $gender         = $_GET['gender'];
    $phone          = $_GET['phone'];
    $email           = $_GET['email'];


    // db 연결
    define('HOST', 'localhost');
    define('USER','root');
    define('PASSWORD','autoset');
    define('DB_NAME','MidTermExam');
    define('TABLE_NAME', 'userinfo');

    $db_con = mysqli_connect(HOST, USER, PASSWORD);
    mysqli_select_db($db_con, DB_NAME);

    // 있는지 없는지 조회.
    $result = mysqli_query($db_con, "select * from ".TABLE_NAME." where userid='$id' ");

    if( mysqli_num_rows($result) == 0)
    {
        echo "<script>alert('ID를 찾을 수 없습니다.')</script>";
        echo "<script>window.location='modify.html'</script>";
    }

    if($re != null){
        if($userid == null || $userpassword == null || $username == null || $phone == null || $email == null)
        {
            echo "<script>alert('아래항목은 필수 항목입니다.')</script>";
            echo "<script>history.back();</script>";
        }
        else {
            $result = mysqli_query($db_con, "update ".TABLE_NAME." set classification='$classification', name='$username', gender='$gender', password='$userpassword', phone='$phone', email='$email' where sysid='$sysid';");
            echo "<script>alert('수정완료')</script>";
            echo "<script>window.location='main.html'</script>";
        }

    }

    for($i = 0; $i < mysqli_num_rows($result); $i++)
    {
        $row = mysqli_fetch_array($result);

        echo "<form action='modifyProcess.php' method='get'>
            <ol>
            <input type='hidden' name='sysid' value='$row[0]'>
            <li>사용자 ID: <input type='text' name='userid' value='$row[1]'></li>
            <li>이름: <input type='text' name='username' value='$row[3]'></li>
            <li>암호: <input type='text' name='userpassword' value='$row[5]'></li>
            <li>구분: <select name='classification'>
                <option value='staff' >교직원</option>
                <option value='student' selected>학생</option>
            </select></li>
            <li>성별: <select name='gender'>
                <option value='male'>남성</option>
                <option value='female' selected>여성</option>
            </select></li>
            <li>전화번호: <input type='text' name='phone' value='$row[6]'></li>
            <li>이메일: <input type='text' name='email' value='$row[7]'></li>
        </ol>
        ";

        echo "<input type='submit' name='re' value='수정하기'></form>";
    }
?>