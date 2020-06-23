<!DOCTYPE html>
<?php
    $stunum = ($_POST['stunum']);
    $name = ($_POST['name']);
    $sex = ($_POST['sex']);
    $dep = ($_POST['dep']);
    $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
    if(!$con){
        die("error:".mysqli_connect_error());
    }
    mysqli_select_db( $con, 'student' );
    $sql0 = "select num from depname where depna = '$dep';";
    $result = mysqli_query($con,"$sql0");
    if (!$result) {
        echo 'Error: ' . $sql0 . "<br>" . $con->error;
        echo '<br><a href="../add_student.html">重新添加</a>';
    } else {
        $row = mysqli_fetch_array($result);
        if (!empty($stunum) && !empty($name) && !empty($sex)) { 
            $num = $row['num'];
            $sql="insert into idstu values ('$stunum', '$sex', '$name', '$num');";
            $sql2 = "insert into userpwd values ('$stunum', 'e10adc3949ba59abbe56e057f20f883e');";
            if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE) {
                $upyes="update copyrecord set up = 'YES';";
                $con->query($upyes);
                echo '学生'.$name.'的信息录入成功';
                echo '<br><a href="../add_student.html">继续插入</a>';
                echo '<br><a href="../main_adm.php">返回界面</a>';
            } else {
                echo 'Error: ' . $sql . "<br>" . $con->error;
                echo '<br><a href="../add_student.html">重新添加</a>';
            }

            $con->close();
        }
    }
?>
<html>
<head>
        <meta charset="utf-8">
        <title>add_student</title>
        <meta name="lyx" content="database on web">
</head>
</html>