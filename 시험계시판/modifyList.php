<?php
    for($i = 0; $i < mysqli_num_rows($result); $i++)
    {
        $row = mysqli_fetch_array($result);

        echo "<form action='modifyProcess.php' method='get'>
                <ol>
                <input type='hidden' name='sysid' value='$row[0]'>
                <li>사용자 ID: <input type='text' name='userid' value='$row[1]'></li>
                <li>이름: <input type='text' name='username' value='$row[3]'></li>
                <li>암호: <input type='text' name='userpassword' value='$row[5]'></li>
                <li>구분: <select name='classification'>
                    <option value='staff' >교직원</option>
                    <option value='student' selected>학생</option>
                </select></li>
                <li>성별: <select name='gender'>
                    <option value='male'>남성</option>
                    <option value='female' selected>여성</option>
                </select></li>
                <li>전화번호: <input type='text' name='phone' value='$row[6]'></li>
                <li>이메일: <input type='text' name='email' value='$row[7]'></li>
            </ol>
            ";

        echo "<input type='submit' name='re' value='수정하기'></form>";
    }

?>