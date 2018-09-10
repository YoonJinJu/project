<!DOCTYPE html>
<?php
session_start();

if($_SESSION != null) {
    echo "<B style='padding-left: 1100px; margin-bottom: 50px; font-size:18px'>$_SESSION[id] 님</B>";
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Board</title>
        <style>
            body {
                border: 4px solid #FFD8D8;
            }
            h1 {
                text-align: center;
                margin-top: -10px;
            }

            button {
                width: 90px;
                height: 35px;
                font-size: 15px;
                margin-left: 60%;
                background-color: lightpink;
            }

            #table {
                font-size: 20px;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <br>
        <h1> 게시판 </h1>
        <button onclick="location.replace('writeTemplate.html')"><B> 글쓰기 </B></button>
        <br>
        <br>
    </body>
</html>

<?php
    include 'list.php';
?>

<?php
    // contents의 개수를 가지고 있는 변수.
    $page_count = $result_Page_Count / 5;

    $page_count = ceil($page_count);
    $page_eye = 1;

    echo "<div style='text-align: center; font-size: 20px; '>";
    echo "<a > &laquo; </a>";
    while($page_count > 0 )
    {
        echo "<a href='http://localhost/main_board.php?page=$page_eye' style='text-decoration: none'> $page_eye </a>";
        if($page_count == $page_eye)
        {
            break;
        }
        $page_eye++;
    }
    echo "<a> &raquo; </a>";
    echo "</div>";
?>


