<?php
    session_start();

    if($_SESSION != null) {
        echo "<B>$_SESSION[id]님이 로그인 하셨습니다.</B>";
    }
?>