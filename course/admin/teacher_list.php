<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <style>
        a{
            color: mintcream;
        }
    </style>

</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from teacher";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">教师ID</th>
        <th width="20%">教师姓名</th>
        <th width="20%">教师职称</th>
        <th width="40%">教师所在系</th>
        <th width="10%">操作管理 <span class='am-badge am-badge-success'><a href="teacher_add.php">添加教师</a></span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $teacher_id = $row['teacher_id'];
        $teacher_name = $row['teacher_name'];
        $teacher_positional  = $row['teacher_positional'];
        $teacher_department = $row['teacher_department'];
        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$teacher_id</td>
            <td>$teacher_name</td>
            <td>$teacher_positional</td>
            <td>$teacher_department</td>
            <td><span class='am-badge am-badge-success'><a href='teacher_change.php?teacher_id=$teacher_id'>修改</a></span> <span class='am-badge am-badge-danger'><a href='teacher_del.php?teacher_id=$teacher_id'>删除</a></span></td>
        </tr>
        ";
        $i++;
    }
    $pdo = null;
    ?>
    </tbody>
</table>
</body>
</html>