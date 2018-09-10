<html>
<head>
    <style>
        #text {
            width: 300px;
            height: 300px;
        }

        #title {
            width:250px;
        }

        #color {
            background-color: #6799FF;
            color: white;
            width: 100px;a
            margin-bottom: 10px;
        }


        html {
            text-align: center;
            font-size: 15px;
        }

        fieldset {
            border: solid 3px #B2CCFF;
            width: 700px;
            align-content: center;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
    <script>
    </script>
</head>

<?php
    // 해당 글의 아이디를 받는다.
    $board_id   = $_GET[board_id];

    $db_con = mysqli_connect(localhost,root,autoset);

    mysqli_select_db($db_con, ycj_test);

    $qeury = "select * from new_board where board_id = '$board_id'";
    $result = mysqli_query($db_con, $qeury);
    $result = mysqli_fetch_array($result);
    $subject = $result['subject'];
    $contents = $result['contents'];

    echo "/> 
            </fieldset>
        </form>
    </body>
</html>";

    include "replay.php";

?>