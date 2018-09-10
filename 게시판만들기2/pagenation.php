<?php
    if(!isset($page_shift) && !isset($minus))
    {
        $pagenation_num = 1;
    }
    else {
        $pagenation_num = $minus;
    }

    $see_max = 3;

    if($page_shift == ">>")
    {
        $pagenation_num++;

    }

    if($pagenation_count <= 3)
    {
        $pagenation_num = 1;
        $see_max = $pagenation_count;
    }

    if($minus+2 >= $pagenation_count)
    {
        $pagenation_num = $minus;
    }

    if($page_shift == "<<")
    {
        $pagenation_num--;
    }

    if($pagenation_num == 0)
    {
        $pagenation_num = 1;
    }

    session_start();
    $select = $_SESSION['select'];
    $find = $_SESSION['find'];
    echo "<form action='backboard.php' method='get'>";
    echo "<input type='submit' value='<<' name='page_shift' id='pagenation_shift'> &nbsp";
    for($see = 0, $j = $pagenation_num; $see < $see_max; $see++, $j++)
    {
        echo "<input type='submit' value='$j' name='page_num' id='pagenation_num'>";

    }echo "<input type='hidden' value='$pagenation_num' name='minus-2'>";
    echo "<input type='hidden' value='$select' name='select'>";
    echo "<input type='hidden' value='$find' name='find'>";
    echo " &nbsp<input type='submit' value='>>' name='page_shift' id='pagenation_shift'>";
    echo "</form>";
?>