
<?php
    // 공통적으로 사용할 table 형식.php
    // table 출력
    echo "<table style='border: solid 1px white'>";
    echo "<tr id='table_list' style='height:30px'>";
    echo "<td style='width: 70px'><B> 번호 </B></td>";
    echo "<td style='width: 350px'><B> 제목 </B></td>";
    echo "<td style='width: 200px'><B> 작성자 </B></td>";
    echo "<td style='width: 70px'><B> 조회수 </B></td>";
    echo "<td style='width: 200px'><B> 작성일 </B></td>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result)){
        echo "<tr style='height:30px;'>";
        echo "<td>$row[board_id]</td>";
        // 제목에 하이퍼링크 걸기
        $title = $row[subject];
        echo "<td><a href='write_board.php?board_id=$row[board_id]&subject=$row[subject]&contents=$row[contents]' style='text-decoration:none; color:black'>$title</a></td>";
        echo "<td>$row[user_id]</td>";
        echo "<td>$row[hits]</td>";
        echo "<td>$row[reg_date]</td>";
        echo "</tr>";
    }
    echo "</table><br>";

?>