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

$sql = "SELECT * from test";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">评测ID</th>
        <th width="40%">评测标题</th>
        <th width="10%">评测课程</th>
        <th width="10%">评测类型</th>
        <th width="20%">发布时间</th>
        <th width="10%">操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $test_id = $row['test_id'];
        $test_title = $row['test_title'];
        $test_type = $row['test_type'];
        $test_time = $row['test_time'];
        $course_id = $row['course_id'];

        $sql = "SELECT * from course WHERE course_id='$course_id'";
        $result_course = $pdo->query($sql);
        $course_name = "";
        while($row_course = $result_course->fetch()){
            $course_name = $row_course['course_name'];
        }

        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$test_id</td>
            <td>$test_title</td>
            <td>$course_name</td>
            <td>$test_type</td>
            <td>$test_time</td>
            <td><span class='am-badge am-badge-success'><a href='test_change.php?test_id=$test_id'>编辑</a></span> <span class='am-badge am-badge-danger'><a href='test_del.php?test_id=$test_id'>删除</a></span></td>
        </tr>
        ";
        $i++;
    }
    ?>
    </tbody>
</table>
<?php
$pdo = null;
?>
</body>
</html>