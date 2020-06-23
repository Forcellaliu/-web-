<!DOCTYPE html>
<?php
    $stunum = ($_POST['stunum']);
    $course = ($_POST['course']);
    $score = ($_POST['score']);
    $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
    if(!$con){
        die("error:".mysqli_connect_error());
    }
    //插入成绩时，必须学生存在，且新成绩比旧成绩高
    if (!empty($stunum) && !empty($score) && !empty($course)) { 
        $sql="update `student`.stuscores set score = $score where id = '$stunum' and course = '$course';";
        if ($con->query($sql) === TRUE) {
            $upyes="update `student`.copyrecord set up = 'YES';";
            $con->query($upyes);
            echo '学生'.$stunum.'的'.$course.'成绩更新为'.$score;
            echo '<br><a href="../update_score.html">继续插入</a>';
            echo '<br><a href="../main_adm.php">返回界面</a>';
        } else {
            echo 'Error: ' . $sql . "<br>" . $con->error;
            echo '<br><a href="../update_score.html">重新添加</a>';
        }
         
        $con->close();
    }
?>
<html>
<head>
        <meta charset="utf-8">
        <title>add_student</title>
        <meta name="lyx" content="database on web">
</head>
</html>