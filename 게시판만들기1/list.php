<?php
    session_start();

    // 수정 내용 처리하기.
    $new_subject = $_GET['subject'];
    $new_contents = $_GET['contents'];

    if($new_subject != null || $new_contents != null)
    {
        define("HOST", "localhost");
        define("USER", "root");
        define("PASSWORD", "autoset");
        define("DB_NAME", "ycj_test");
        define("TABLE_NAME", "jinju_board");


        //DB에 연결.
        $db_con = mysqli_connect(HOST,USER,PASSWORD);

        // DB를 선택.
        mysqli_select_db($db_con, DB_NAME);

        // update문을 사용하여 update시킨다.
        // update jinju_board set subject = 'dfsfs' where board_id = 1;
        $change_Result_Subject  = "update jinju_board set subject='$new_subject' where board_id=$board_id;";
        mysqli_query($db_con,$change_Result_Subject);

        $change_Result_Contents  = "update jinju_board set contents='$new_contents' where board_id=$board_id;";
        mysqli_query($db_con,$change_Result_Contents);
    }

    // 성적 처리 DB table 생성.
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "autoset");
    define("DB_NAME", "ycj_test");
    define("TABLE_NAME", "jinju_board");

    $subject = $_GET['subject'];
    $contents = $_GET['contents'];
    $count_Page = $_GET['page'];
    $count_Number = 5;

    if($count_Page == null)
    {
        $count_Page = 0;
    }
    else {
        $count_Page = $count_Page - 1;
    }

    $start_counter_number = $count_Page * $count_Number;


    //DB에 연결.
    $db_con = mysqli_connect(HOST,USER,PASSWORD);

    // DB를 선택.
    mysqli_select_db($db_con, DB_NAME);

    // pagnation 개수 구하기
    $page_query = "select * from ".TABLE_NAME;
    $page_Count = mysqli_query($db_con, $page_query);
    $result_Page_Count = mysqli_num_rows($page_Count);


    // board_id 카운트
    $count_query = "select max(board_id) from ".TABLE_NAME;
    $count_1 = mysqli_query($db_con, $count_query);
    $count_2 = mysqli_fetch_array($count_1)['max(board_id)'];

    if($subject != null)
    {
        if($count_2 == null)
        {
            $count_2 = 1;
        }
        else {
            $count_2++;
        }
        // 값 넣기
        // board_id // board_pid(댓글수) // user_id // user_name // subject // contents // hits(조회수) // req_date;
        $query = "insert into ".TABLE_NAME." values('$count_2', 1, 'pdu04061', '$_SESSION[id]', '$subject', '$contents', 1, NOW());";
    }

    mysqli_query($db_con, $query);
    $attend = "select * from ".TABLE_NAME;
    $result = mysqli_query($db_con,$attend);

    // table 삭제하기
    $delete_num = $_GET['delete_board_id'];
    if($delete_num != null)
    {
        $delete_sql = "delete from ".TABLE_NAME." where board_id = ".$delete_num;
        $delete_result = mysqli_query($db_con,$delete_sql);
    }

    // table 출력개수 정하기.
    $change = "select * from ".TABLE_NAME." order by reg_date desc limit $start_counter_number,$count_Number";
    $result = mysqli_query($db_con,$change);



    echo "<table border='1' id ='table'>";
    echo "<tr style='background-color: #FFD8D8; color: #353535'> 
                           <td width='60px'>번호</td>
                           <td width='180px'>작성자</td>
                           <td width='350px'>제목</td>
                           <td width='80px'>조회수</td>
                           <td width='250px'>작성날짜</td>
           </tr>";
    while($array_result = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>$array_result[board_id]</td>";
        echo "<td>$array_result[user_name]</td>";
        $title = $array_result[subject];
        echo "<td><a href='file_open.php?board_id=$array_result[board_id]&subject=$title&contents=$array_result[contents]' style='text-decoration: none; color: black'>$title</a></td>";
        echo "<td>$array_result[hits]</td>";
        echo "<td>$array_result[reg_date]</td>";
        echo "</tr>";
    }
    echo "</table><br>";
    mysqli_close($db_con);
?>