<?php
    $id       = $_GET['id'];
    $password = $_GET['password'];

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
    $row    = mysqli_fetch_array($result);

    if($row['userid'] == $id)
    {
        if($row['password'] == $password)
        {
            $result = mysqli_query($db_con, "delete from ".TABLE_NAME." where userid='$id' and password='$password'");
            echo "<script>window.location='../시험계시판/main.html'</script>";
        }
        else{
            echo "<script>alert('암호가 일치하지 않습니다.')</script>";
            echo "<script>window.location='delete.html'</script>";
        }
    }
    else{
        echo "<script>alert('등록되지 않은 ID입니다.')</script>";
        echo "<script>window.location='delete.html'</script>";
    }
?>