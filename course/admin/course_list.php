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
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from course";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">课程ID</th>
        <th width="79%">课程名</th>
        <th width="13%">操作管理 <span class='am-badge am-badge-success'><a href="course_add.php">添加课程</a></span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $course_id = $row['course_id'];
        $course_name = $row['course_name'];
        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$course_id</td>
            <td>$course_name</td>
            <td><span class='am-badge am-badge-success'><a href='course_change.php?course_id=$course_id'>修改</a></span> <span class='am-badge am-badge-danger'><a href='course_del.php?course_id=$course_id'>删除</a></span></td>
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