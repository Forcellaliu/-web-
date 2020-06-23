<!DOCTYPE html>
<?php
    header("Content-Type:text/html;charset=utf-8");
    $data[0] = ($_POST['stunum']);
    $data[1] = ($_POST['name']);
    $data[2] = ($_POST['sex']);
    $data[3] = ($_POST['dep']);
    $data[4] = ($_POST['course']);
    $data[5] = ($_POST['scoreup']);
    $data[6] = ($_POST['scoredown']);
    $kind = array("id","name","sex", "depna", "course", "score");
    $con = mysqli_connect('localhost', 'root', 'root'); //准备SQL语句
    if(!$con){
        die("error:".mysqli_connect_error());
    }
    mysqli_select_db( $con, 'student' );
    $sql = "select * from stuscores right join idstu on stuscores.id = idstu.id left join depname on depnum = num";
    $sql2 = " where ";
    for ($n = 0, $count = 0; $n < 5; $n++) {
        if ($data[$n] != " "){
            if ($count == 0) {
                $count++;
                if ($data[0] != 0) {
                    $sql2 = $sql2."idstu.".$kind[$n]." ="."'".$data[$n]."'";
                } else {
                    $sql2 = $sql2.$kind[$n]." ="."'".$data[$n]."'";
                }
            } else {
                $sql2 = $sql2." and ".$kind[$n]." = "."'".$data[$n]."'";
            }
            
        } 
    }
    if ($count == 0) {
        $sql2 = $sql2." score <= ".$data[5]." and score >= ".$data[6];;
    } else {
        $sql2 = $sql2." and score <= ".$data[5]." and score >= ".$data[6];
    }
    $sql = $sql.$sql2." for update;";
    //echo "<br>".$sql."<br>count=".$count;
    mysqli_query($con, "begin");//事务开始
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        mysqli_query($con, "commit");
        echo "<h2>查询成功！</h2>
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
                    <tbody>";
        do{
            echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['sex']."</td><td>".$row['depna']."</td><td>".$row['course']."</td><td>".$row['score']."</td></tr>";
        }while($row = mysqli_fetch_array($query));
        echo "</tbody>";
        echo '点击 <a href="../main_adm.php">回到主页</a>或<a href="../select.html">再次查询</a><p>';
    } else {
        echo '<br>查询错误！点击 <a href="../select.html">重新查询</a><p><br>';
        mysqli_query($con, "rollback");
    }
?>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>add_score</title>
        <meta name="lyx" content="database on web">
</head>
<body>
</body>
</html>