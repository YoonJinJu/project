<?php
?>

<html>
    <head>
        <style>
            html {
                text-align: center;
                font-size: 15px;
            }

            table {
                align-content: center;
                margin-left: auto;
                margin-right: auto;
            }
            fieldset {
                border: solid 3px #B2CCFF;
                width: 500px;
                align-content: center;
                margin-left: auto;
                margin-right: auto;
            }

            #text {
                width: 150px;
            }

            #submit {
                width: 70px;
                height: 50px;
                background-color: #4374D9;
                color: white;
            }
        </style>
    </head>
    <body>
        <br><br><br><br>
        <form action="login_page.php" method="get">
            <fieldset>
                <br>
                <br>
                <table>
                    <tr><td style="float: right"><B>ID : </B><input type="text" value="" name="id" id="text"></td>
                        <td rowspan="2"><input type="submit" value="로그인" id="submit"></td>
                    </tr>
                    <tr><td style="float: right"><B>PASSWORD : </B><input type="text" value="" name="password" id="text"></td></tr>
                </table>
                <br><br>
            </fieldset>
        </form>
    </body>
</html>

<?php
    // 로그인 관리
    $id = $_GET['id'];
    $password = $_GET['password'];

    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "autoset");
    define("DB_NAME", "ycj_test");
    define("TABLE_NAME", "login");

    // db연결
    $db_con = mysqli_connect(HOST,USER,PASSWORD);

    // DB 선택
    mysqli_select_db($db_con, DB_NAME);

    if($id != null && $password != null) {
        $query = "select * from ".TABLE_NAME." where id LIKE '%$id%' and password LIKE '%$password%'";
        $result = mysqli_query($db_con, $query);

        $count = mysqli_num_rows($result);

        if($count == 1)
        {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['password'] = $password;
            echo "<script>window.location = 'backboard.php'</script>";
        }
        else {
            echo "<script>alert('아이디/비밀번호가 틀렸습니다.')</script>";
        }
    }
    else {
        echo "<script>alert('아이디/비밀번호를 입력해주세요.')</script>";
    }
?>