<html>
    <head>
        <style>
            fieldset {
                border: solid 3px #B2CCFF;
                width: 700px;
                align-content: center;
                margin-right: auto;
                margin-left: auto;
            }
            #replay {

                width: 400px;
                height: 50px;
            }
            #replay_save {
                background-color: #6799FF;
                color: white;
                width:100px;
                height: 50px;
            }
        </style>
    </head>
    <body>
        <form method="get" action="write_board.php">
                <fieldset>
                <br>
                <input type="text" name="replay" value="" id="replay">
                <input type="submit" name="replay_save" value="댓글달기" id="replay_save">
                <?php
                    echo "<input type='hidden' name='board_id' value='$board_id' />"
                ?>
                <br><br>
                <hr style="border: dashed 2px #B2CCFF">
                <?php
                    $replay = $_GET[replay];
                    $delete = $_GET[delete];
                    $reg_date = $_GET[reg_date];
                    $count = $_GET[count];

                    $db_con = mysqli_connect(localhost,root,autoset);
                    mysqli_select_db($db_con, ycj_test);

                    // 댓글 총 개수 세기
                    if($count == null)
                    {
                        // row 개수세기 = board_id 파악
                        $result = mysqli_query($db_con, "select max(count) from replay");
                        $count = mysqli_fetch_array($result)['max(count)'];
                        $count++;
                    }

                    if($replay != null)
                    {
                        $query = "insert into replay values($board_id, $count, '$replay', NOW());";
                        $reault = mysqli_query($db_con, $query);
                    }

                    // 삭제시
                    if($delete != null)
                    {
                        $query = "delete from replay where count = $count";
                        mysqli_query($db_con, $query);
                    }

                    // 댓글 출력
                    $query = "select * from replay where board_id = $board_id order by reg_date";
                    $result = mysqli_query($db_con,$query);

                    $count = 1;

                    while ($row = mysqli_fetch_array($result)){
                        echo "<tr style='height:30px;'>";
                        echo "<td>$count &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                        echo "<td>$row[replay] &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                        echo "<td>$row[reg_date]&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                        echo "<td><a href='write_board.php?delete=1&count=$row[count]&board_id=$row[board_id]'>삭제</a></td><br>";
                        $count++;
                        echo "</tr>";
                    }
                ?>
            </fieldset>
        </form>
    </body>
</html>

<?php

?>