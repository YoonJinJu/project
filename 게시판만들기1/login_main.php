<html>
    <head>
        <style>
            body {
                border: 4px solid #FFD8D8;
                width: 400px;
                height:200px;
                margin-top: 100px;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }

            #submit {
                background-color: lightpink;
                height: 50px;
                width: 70px;
                font-size: 15px;
            }

            table {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <br>
        <h2>로그인</h2>
        <form action="login_main.php" method="get">
            <table>
                <tr>
                    <td style="padding-left: 55px">ID <input type="text" name = "id"/><br></td>
                    <td rowspan="2"><input id = "submit" type="submit" value="login"/></td>
                </tr>
                <tr>
                    <td>PASSWORD <input type="text" name = "password"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>

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

    $query = "select * from ".TABLE_NAME;

    // 명령어 실행
    $db_result = mysqli_query($db_con,$query);

    $ID         = $_GET['id'];
    $PASSWORD   = $_GET['password'];

    // ID & PASSWORD 검사
    if($ID != null && $PASSWORD != null)
    {
        $sql = "select * from ".TABLE_NAME." where id = '$ID' and password = '$PASSWORD';";

        $result = mysqli_query($db_con,$sql);

        $count = mysqli_num_rows($result);

        if($count == 1)
        {
            session_start();
            $_SESSION['id'] = $ID;
            $_SESSION['password'] = $PASSWORD;
            echo "<script> window.location = 'main_board.php'</script>";
        }
        else
        {
            echo "<script>alert('아이디나 비밀번호가 틀렸습니다. 다시 입력해주세요.')</script>";
        }
    }
    else
    {
        echo "<script> alert('아이디와 비밀번호를 입력하세요.')</script>";
    }

?>

