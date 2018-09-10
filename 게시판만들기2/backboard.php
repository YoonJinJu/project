<html>
    <head>
        <a href="backboard.php" style="text-decoration: none; color: black"><h1>게시판</h1></a>
        <style>
            html {
                text-align: center;
            }

            table {
                align-content: center;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                size: 20px;
                font-size: 17px;
            }

            table tr:nth-child(2n) {
                background-color: #EAEAEA;
            }

            #table_list {
                background-color: #6799FF;
                color: white;
            }

            input {
                margin-bottom: 4px;
                background-color: #4374D9;
                font-weight: 900;
                color: white;
                width: 100px;
                height: 30px;
            }

            #button {
                margin-left: 100px;
            }

            #pagenation_shift {
                width:40px;
                background-color: #6799FF
            }

            #pagenation_num {
                width:30px;
                background-color: white;
                color: black;
            }

            #text {
                width: 250px;
                height: 25px;
                background-color: white;
                color: black;
            }

            #find_form {
                display: inline;
            }
        </style>
    </head>
        <body>
        <form action="backboard.php" method="get" id="find_form">
            <select style="height: 25px" name="select">
                <option>제목</option>
                <option>작성자</option>
            </select>
            <input type="text" value="" name="find" id="text">
            <input type="submit" value="찾기">
        </form>


        <input type="button" value="글쓰기" id = "button" onclick="location.href='write_board.php'">
        <?php
            session_start();

            if( $_SESSION['id'] != null && $_SESSION['id'] != 'A')
            {
                echo $_SESSION['id'] ."님";
                echo "></html>";
            }
            else {
                echo "></html>";
            }
        ?>
    </body>
</html>

<?php
    // 글의 제목. 내용.
    $subject  = $_GET['title'];
    $contents = $_GET['contents'];
    $board_id = $_GET['board_id'];
    $submit   = $_GET['submit'];
    $contents_count = 0;

    // DB에 사용자 추가.
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "autoset");
    define("DB_NAME", "ycj_test");
    define("TABLE_NAME", "new_board");

    // DB 연결
    $db_con  = mysqli_connect(HOST,USER,PASSWORD);

    // DB 선택
    mysqli_select_db($db_con, DB_NAME);

    if($board_id == null)
    {
        // row 개수세기 = board_id 부여를 위한 파악.
        // 최대 board_id table 의 max(board_id)칸의 숫자를 파악해서 하나씩증가시켜준다.
        $result = mysqli_query($db_con, "select max(board_id) from " . TABLE_NAME);
        $board_id = mysqli_fetch_array($result)['max(board_id)'];
        $board_id++;
    }

    // 로그인 할 경우 user_id로 작성
    session_start();
    if($_SESSION['id'] != null)
    {
        $user_id = $_SESSION['id'];
    }
    else {
        $_SESSION['id'] = 'A';
        $user_id = $_SESSION['id'];
    }

    // 저장할시
    if($submit == '저장하기')
    {
        // board_pid(댓글수) // user_id // user_name // subject // contents // hits(조회수) // reg_date;
        $query = "insert into " . TABLE_NAME . " values($board_id, 1, '$user_id', 'jinju', '$subject', '$contents', 1, NOW());";
        mysqli_query($db_con, $query);
    }

    // 수정할시
    if($submit == '수정하기')
    {
        // 권한 파악
        $query = "select * from ".TABLE_NAME." where board_id = $board_id and user_id = '$user_id'";
        $result = mysqli_query($db_con,$query);

        $a = mysqli_fetch_array($result)['user_id'];
        $b = $_SESSION['id'];
        if($a == $b)
        {
            // update new_board set subject = '안녕', contents = '잘가' where board_id = 1;
            $query = "update ".TABLE_NAME." set subject = '$subject', contents = '$contents' where board_id = '$board_id'";
            if(mysqli_query($db_con, $query))
            {
                echo "<script>alert('수정완료')</script>";
            }
            else {
                echo "<script>alert('수정실패')</script>";
            }
        }
        else {
            echo "<script>alert('수정할 권한이 없습니다.')</script>";
        }

    }

    // 삭제할시
    if($submit == '삭제하기')
    {
        // 아이디 파악
        $query = "select * from ".TABLE_NAME." where board_id = $board_id and user_id = '$user_id'";
        $result = mysqli_query($db_con,$query);

        if(mysqli_fetch_array($result)['user_id'] == $_SESSION['id'])
        {
            $query = "delete from ".TABLE_NAME." where board_id = '$board_id'";
            mysqli_query($db_con, $query);
        }
        else {
            echo "<script>alert('삭제할 권한이 없습니다.')</script>";
        }

    }

    // 원하는 내용을 찾을 경우
    $select = $_GET['select'];
    $find = $_GET['find'];
    //페이지네이션 변수
    $page_num = $_GET['page_num'];
    $page_shift = $_GET['page_shift'];
    $minus = $_GET['minus-2'];

    // 찾을 내용이 있을 경우 출력결과
    if($find != null)
    {
        @session_start();
        if($select == '제목')
        {
            $_SESSION['select'] = '제목';
            $_SESSION['find'] = $find;
            $query = "select * from new_board where subject = '$find'";
            $count_query = "select count(*) from new_board where subject = '$find'";
            $list_query = "select * from new_board where subject = '$find' order by reg_date desc limit $start_num, $limit";
        }
        else if($select == '작성자') {
            $_SESSION['select'] = '작성자';
            $_SESSION['find'] = $find;
            $query = "select * from new_board where user_id = '$find'";
            $count_query = "select count(*) from new_board where user_id = '$find'";
        }

        $result_1 = mysqli_query($db_con, $query);

        $row_count = mysqli_query($db_con, $count_query);

        // 페이지네이션 개수
        $row_count = mysqli_fetch_array($row_count)['count(*)'];

        $row_count = $row_count / 5;
        $pagenation_count = ceil($row_count);

        // 페이지 숫자가 없을 경우 첫페이지 출력.
        if($page_num == null)
        {
            $page_num = 1;
        }

        // limit 는 0부터 시작.
        $start_num = 5 * ($page_num - 1);
        $limit = 5;

        if($select == '제목')
        {
            $list_query = "select * from new_board where subject = '$find' order by reg_date desc limit $start_num, $limit";
        }
        else if($select == '작성자') {
            $list_query = "select * from new_board where user_id = '$find' order by reg_date desc limit $start_num, $limit";
        }
        $result = mysqli_query($db_con,$list_query);

        include 'table.php';
        include 'pagenation.php';

        // 찾을 내용이 없을 경우.
        if(mysqli_num_rows($result_1) == 0)
        {
            echo "<script>alert('찾을 내용이 없습니다.')</script>";
        }
    }
    // 찾을 내용이 없을 경우 모두 출력력
   else {
        // table 표시 개수
        $query = "select count(*) from new_board";
        $row_count = mysqli_query($db_con, $query);

        // 페이지네이션 개수
        $row_count = mysqli_fetch_array($row_count)['count(*)'];
        $row_count = $row_count / 5;
        $pagenation_count = ceil($row_count);

        // 페이지 숫자가 없을 경우 첫페이지 출력.
        if($page_num == null)
        {
            $page_num = 1;
        }

        // limit 는 0부터 시작.
        $start_num = 5 * ($page_num - 1);
        $limit = 5;

        // 내림차순 정렬 + 페이지 네이션
        $query = "select * from ".TABLE_NAME." order by reg_date desc limit $start_num, $limit";
        $result = mysqli_query($db_con,$query);

        include 'table.php';
        include 'pagenation.php';
    }
?>
