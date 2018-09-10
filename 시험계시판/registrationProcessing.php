<?php
    $userid             = $_GET['userid'];
    $userpassword       = $_GET['userpassword'];
    $username           = $_GET['username'];
    $classification     = $_GET['classification'];
    $gender             = $_GET['gender'];
    $phone              = $_GET['phone'];
    $email              = $_GET['email'];

    if($userid == null)
    {
        echo "<P> 사용자 아이디가 입력되지 않았습니다.</P>";
    }
    if($userpassword == null)
    {
        echo "<P> 사용자 비밀번호가 입력되지 않았습니다.</P>";
    }
    if($username == null)
    {
        echo "<P> 사용자 이름이 입력되지 않았습니다.</P>";
    }
    if($phone == null)
    {
        echo "<P> 전화번호가 입력되지 않았습니다.</P>";
    }
    if($email == null)
    {
        echo "<P> 이메일이 입력되지 않았습니다.</P>";
    }
    if($userid != null && $userpassword != null && $username != null && $phone != null && $email != null) {


        // db 연결
        $db_con = mysqli_connect(HOST, USER, PASSWORD);
        mysqli_select_db($db_con, DB_NAME);

        $result = mysqli_query($db_con, "select max(sysid) from " . TABLE_NAME);
        $sysid = mysqli_fetch_array($result)['max(sysid)'];

        $sysid++;

        // 추가하기
        //insert userinfo values(1,'pdu','123','jin','학생','여성','010','pud');
        $query = "insert into " . TABLE_NAME . " values($sysid , '$userid', '$classification', '$username', '$gender', '$userpassword', '$phone', '$email')";
        if (mysqli_query($db_con, $query)) {
            echo "<script>window.location='main.html'</script>";
        }

    }

    // selected 파악하기. ($classification, $gender)
    if($classification == 'staff')
    {
        $staff = "selected";
    }
    else {
        $student = "selected";
    }

    if($gender == 'male') {
        $male = "selected";
    }
    else {
        $female = "selected";
    }
    echo ">
    </form>";
?>