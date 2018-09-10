<?php
// db 연결
define('HOST', 'localhost');
define('USER','root');
define('PASSWORD','autoset');
define('DB_NAME','MidTermExam');
define('TABLE_NAME', 'userinfo');
$limit = 5;
$page_num = $_GET['page_num'];
$left = $_GET['left'];
$right = $_GET['right'];
$minus = $_GET['minus'];
$a = $_GET['page_num'];

$db_con = mysqli_connect(HOST, USER, PASSWORD);
mysqli_select_db($db_con, DB_NAME);

// 페이지네이션 개수 구하기
$content_count = mysqli_query($db_con, "select count(*) from ".TABLE_NAME);
$content_count = mysqli_fetch_array($content_count)['count(*)'];
$last_PagenationCount = ceil($content_count / $limit);
// 첫페이지는 무조건 0 // page_num 이 안들어왔으면 page 0;
echo $page_num;

if($page_num == null)
{
    $page_num = 1;
}

$first_num = ($page_num - 1) * $limit;

$result = mysqli_query($db_con, "select * from ".TABLE_NAME." order by sysid desc limit $first_num, $limit");

// select문 -> fetch_array/ fetch_assoc -> 레코드 단위 -> for문을 통해 field로 접근.
echo "<table><tr style='background-color: gainsboro; width: 200px; height: 30px' >
                        <td>  <B>sys</B> </td>
                        <td > <B>ID</B> </td>
                        <td > <B>이름</B> </td>
                        <td > <B>암호</B> </td>
                        <td > <B>구분</B> </td>
                        <td > <B>성별</B> </td>
                        <td > <B>전화번호</B> </td>
                        <td > <B>이메일</B> </td>
                    </tr>";


for($i = 0; $i < mysqli_num_rows($result); $i++) {
    $row = mysqli_fetch_array($result);
    echo "          
                <tr>
                    <td style = 'width: 200px'>$row[0]</td>
                    <td style = 'width: 200px'>$row[1]</td>
                    <td style = 'width: 200px'>$row[3]</td>
                    <td style = 'width: 200px'>$row[5]</td>
                    <td style = 'width: 200px'>$row[2]</td></td>
                    <td style = 'width: 200px'>
                    <td style = 'width: 200px'>$row[4]$row[6]</td>
                    <td style = 'width: 200px'>$row[7]</td>
                </tr>
            
            ";
}
echo "</table>";

// 페이지네이션
if($page_num <= 3)
{
    $page_num = 1;
}

// <<
if($left == "<<")
{
    --$minus;

    if($page_num == 0)
    {
        $page_num = 1;
    }
}

if($right == ">>" && $last_PagenationCount != $minus+2)
{
    ++$minus;
}

if($minus == null)
{
    $minus = 1;
}


echo "<form action='list.php' method='get'/>";
echo "<a href='list.php?minus=$minus&left=<<&page_num=$a'><<</a>";
echo "<input type='hidden' name='minus' value='$minus' >";
for($count = 1, $j = $minus;  $count <= 3; $count++, $j++)
{
    if($j > $last_PagenationCount)
    {
        break;
    }
    echo "<input type='submit' name='page_num' value='$j'>";
}
echo "<a href='list.php?minus=$minus&right=>>&page_num=$a'>>></a>";
echo "</form>";
?>