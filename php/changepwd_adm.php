<?php
    $pwd = md5($_POST['pwd']);
    $password1 = md5($_POST['password1']);
    $password2 = md5($_POST['password2']);
    if ($password1 != $password2) {
        echo "<script>window.alert('两次密码输入不一致，请重新输入')</script>";
        echo '<a href="../changepwd adm.html">重新输入</a><p>';
    } else {
        $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
        if (!$con) {
            die("error:".mysqli_connect_error());
        }

        $sql = "select * from `student`.userpwd where username = 'admin';";
        $ret = mysqli_query($con, "$sql");
        $row = mysqli_fetch_array($ret); //判断用户名或密码是否正确
        //echo $username."  ".$password1;
        if ($pwd == $row['pwd']) {
            $sql2 = "update `student`.userpwd set pwd = '$password1' where username = 'admin';";
            $con->query($sql2);
            echo "<script>window.alert('密码修改成功！请返回登录页面重新登录')</script>";
            echo '<br><a href="../login.html">返回登录界面</a><p>';
        } else {
            
            echo "<script>window.alert('原密码输入错误，请重新输入')</script>";
            echo '<br><a href="../changepwd_adm.html">重新输入</a><p>';
        }
    }
    mysqli_close($con);
?>