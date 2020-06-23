<!DOCTYPE html>
<?php
    /*function check_input($value) {
        if(get_magic_quotes_gpc()) {
            $value = htmlspecialchars(trim($value));
        } else {
            $value = addslashes(htmlspecialchars(trim($value)));
        }
        return $value;
    }*/
    $username = ($_POST['username']);
    $password = md5($_POST['password']);
    $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
    if(!$con){
        die("error:".mysqli_connect_error());
    }
    if (!empty($username) && !empty($password)) { //建立连接
        //check_input($username);
        $sql="select * from `student`.userpwd where username= '$username';";//' or 1 #
        $ret = mysqli_query($con, "$sql");
        if (!$ret) {
            mysqli_close($con);
            echo '用户名不存在，点击此处 <a href="../login.html">login</a> 登录！<br/>';
        } else {
            $row = mysqli_fetch_array($ret); //判断用户名或密码是否正确
            if ($username == $row['username'] && $password == $row['pwd']) { //并非通过结果为真来验证，防止注入
                //设置Session
                session_start();
                $_SESSION['user'] = $username;
                mysqli_close($con);
                if($username != "admin") {
                    echo '<h1>登陆成功！</h1><p>'.$username.'，欢迎你！点击进入 <a href="../main_user.php">用户中心</a><p><br>';
                } 
                else {
                    echo '<h1>登陆成功！</h1><p>管理员大人，欢迎回来QWQ！<br>点击进入 <a href="../main_adm.php">管理中心</a><p><br>';
                }

            } else { //用户名密码错误，提示返回重新登录
                mysqli_close($con);
                echo '用户名密码错误，点击此处 <a href="../login.html">login</a> 登录！<br/>';
            }
        }
    } else { //用户名或密码为空，提示返回重新登录
        mysqli_close($con);
        echo '用户不能为空，点击此处 <a href="../login.html">login</a> 登录！<br/>';
        
    } 

?>
<html>
<head>
        <meta charset="utf-8">
        <title>check</title>
        <meta name="lyx" content="database on web">
</head>
</html>