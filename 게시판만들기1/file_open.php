<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>writeTemplate</title>
    <style>
        fieldset {
            width: 350px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        #title {
            width: 250px;
        }

        #subject {
            width: 250px;
        }

        #contents {
            width: 289px;
            height: 200px;
        }


        #submit {
            background-color: lightpink;
            height: 30px;
            width: 80px;
            font-size: 15px;
        }

    </style>
    <script>
        // 예외 처리.
        function check() {
            // title안의 입력값을 title에 담는다.
            var subject = document.getElementById('subject').value;

            // title안의 입력값이 null인경우
            if(subject == "")
            {
                var spend = document.querySelector('form');
                // form submit을 전송하지않고 경고문.
                spend.setAttribute('onsubmit' , 'return false;');
                alert('제목을 입력해주세요.');
            }
            else {
                var spend = document.getElementById('form');
                // form submit을 전송한다.
                spend.setAttribute('onsubmit','return true');
            }
        }

        // 공백과 줄바꿈 인식을 위해 바꿔줌.
        function change() {
            str = document.getElementById('contents').value;
            str = str.replace(/ /gi, "&nbsp;");
            str = str.replace(/\n/gi, "<br/>");
        }

        function back() {
            document.location.href = 'main_board.php';
        }

    </script>
</head>
<?php
    // 수정하기.
    $board_id = $_GET['board_id'];
    $subject  = $_GET['subject'];
    $contents = $_GET['contents'];

    echo "<body>" ;
        echo "<form action='main_board.php' method='get'>";
            echo "<fieldset style='border: 4px solid lightpink'>";
                echo "<legend><h2>[ 글쓰기 ]</h2></legend>"."<br>";
                echo "<B> 제목 </B><input type='text' name='subject' id='subject' value='$subject'>"."<br>"."<br>";
                echo "<B> 내용 </B>"."<br>";
                echo "<textarea name='contents' id='contents'>$contents</textarea>"."<br>"."<br>";
                echo "<input name = 'board_id' type='hidden' value='$board_id'>";
                echo "<input id = 'submit' type = 'submit' onclick='change(); check();' value='수정하기'/>";
                echo "</form>";
                echo "<form action='main_board.php' method='get'>";
                    echo "<br>";
                    echo "<input name = 'delete_board_id' type='hidden' value='$board_id'>";
                    echo "<input id = 'submit' type = 'submit' value='삭제하기' />";
                echo "</form>";
                echo "</fieldset>";
    echo "</body>";
    echo "</html>";
?>
