<!DOCTYPE html>
<?php
    session_start();
    $username = $_SESSION['user'];
    echo "学生成绩统计如下：<br><br>";
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
            function add_student(){
                window.location.href="add_student.html";
            }
            function change_score(){
                window.location.href="update_score.html";
            }
            function insert_score(){
                window.location.href="add_score.html";
            }
            function copy_data(){
                window.location.href="php/copy_data.php";
            }
            function recover_data(){
                window.location.href="php/recover_data.php";
            }
            function select_data(){
                window.location.href="select.html";
            }
            function changepwd(){
                window.location.href="changepwd_adm.html";
            }
        </script>
    </head>
    <body>
        
        <table id=scoreslist>
            <thead>
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>学院</th>
                <th>科目</th>
                <th>成绩</th>
            </tr>
            </thead>
            <tbody>
                <?php   
                    $con = mysqli_connect('localhost', 'root', 'root');
                    if (!$con) {
                        die("error:".mysqli_connect_error());
                    }
                    mysqli_select_db( $con, 'student' );
                    $find="select * from stuscores right join idstu on stuscores.id = idstu.id left join depname on depnum = num order by num asc, idstu.id asc";
                    $result = mysqli_query($con,"$find");
                    do{
                        echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['sex']."</td><td>".$row['depna']."</td><td>".$row['course']."</td><td>".$row['score']."</td></tr>";
                    }while($row = mysqli_fetch_array($result));
                ?>
            </tbody>
        </table>
        <br>
        <button type="submit" onclick="add_student()">添加学生</button>
        <button type="submit" onclick="change_score()">修改成绩</button>
        <button type="submit" onclick="insert_score()">添加成绩</button>
        <button type="submit" onclick="select_data()">查询数据</button>
        <button type="submit" onclick="changepwd()">修改密码</button>
        <br>
        <button type="submit" onclick="copy_data()">备份数据库</button> 
        <button type="submit" onclick="recover_data()">恢复数据库</button> 
        <?php   
            $date="select * from `student`.copyrecord;";
            $result = mysqli_query($con,"$date");
            $row = mysqli_fetch_array($result);
            echo "<br>上一次备份/恢复日期：".$row['now']."    是否有新的更改：".$row['up'];
            mysqli_close($con);
        ?>
        <br>
        <button type="submit" name = "logout" onclick="logout()">退出管理界面</button>
    </body>
    
</html>