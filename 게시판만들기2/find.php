<?php
    if($select == '제목')
    {
        $query = "select * from new_board where subject = '$find'";
        $count_query = "select count(*) from new_board where subject = '$find'";
        $list_query = "select * from new_board where subject = '$find' order by reg_date desc limit $start_num, $limit";
    }
    else if($select == '작성자') {
        $query = "select * from new_board where user_id = '$find'";
        $count_query = "select count(*) from new_board where user_id = '$find'";
    }
    $result_1 = mysqli_query($db_con, $query);

    $row_count = mysqli_query($db_con, $count_query);

    // 페이지네이션 개수
    $row_count = mysqli_fetch_array($row_count)['count(*)'];

    //페이지네이션 변수
    $page_num = $_GET['page_num'];
    $page_shift = $_GET['page_shift'];
    $minus = $_GET['minus-2'];

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

    echo "<form action='find.php' method='get'>";
    echo "<input type='submit' value='<<' name='page_shift' id='pagenation_shift'> &nbsp";
    for($see = 0, $j = $pagenation_num; $see < $see_max; $see++, $j++)
    {
        echo "<input type='submit' value='$j' name='page_num' id='pagenation_num'>";

    }echo "<input type='hidden' value='$pagenation_num' name='minus-2'>";
    echo " &nbsp<input type='submit' value='>>' name='page_shift' id='pagenation_shift'>";
    echo "</form>";
?>