<!DOCTYPE html>
<?php
    $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
    if(!$con){
        die("error:".mysqli_connect_error());
    }
    $exec="D:/phpstudy/mysql/bin/mysqldump -u root -p root student > D:/tem.sql;";
    exec($exec);
    $date = date("Y-m-d H:i:s");
    echo $date;
    $upno = "update copyrecord set up = 'NO', now = '$date';";
    mysqli_select_db( $con, 'student' );
    $retval = mysqli_query($con, $upno);
    if(! $retval )
    {
        die('无法导出数据: ' . mysqli_error($con));
    } else echo '数据导出成功！';
    $con->close();
    echo '<br>点击进入 <a href="../main_adm.php">管理中心</a><p><br>';
?>
<html>
<head>
        <meta charset="utf-8">
        <title>copyrecord</title>
        <meta name="lyx" content="database on web">
</head>
</html>