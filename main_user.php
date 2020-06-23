<!DOCTYPE html>
<?php
    session_start();
    $username = $_SESSION['user'];
    $con = mysqli_connect('localhost', 'root', 'root');
    if (!$con) {
      die("error:".mysqli_connect_error());
    }
    $helloname="select name from `student`.idstu where id='$username';";
    $name = mysqli_query($con,"$helloname");
    $row = mysqli_fetch_array($name);
    echo $row['name']."，你好！成绩单如下：";
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>showscores-users</title>
        <meta name="lyx" content="database on web">
        <script>
            function logout(){
                sessionStorage.clear();
                window.location.href="login.html";
            }
            function changepwd(){
                window.location.href="changepwd.html";
            }
        </script>
    </head>
    <body>
        
        <table id=scoreslist>
            <thead>
            <tr>
                <th>学科</th>
                <th>成绩</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $find="select course,score from `student`.stuscores where id='$username';";
                    $result = mysqli_query($con,"$find");
                    do{
                        echo "<tr><td>".$row['course']."</td><td>".$row['score']."</td></tr>";
                    }while($row = mysqli_fetch_array($result));
                    mysqli_close($con);
                ?>
            </tbody>
        </table>
        <br>
        <button type="submit" name = "submit" onclick="changepwd()">修改密码</button>
        <br>
        <button type="submit" name = "logout" onclick="logout()">退出登录</button>
    </body>
    
</html>