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

$sql = "SELECT * from course_information";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">信息ID</th>
        <th width="10%">信息课程</th>
        <th width="10%">信息类型</th>
        <th width="45%">信息标题</th>
        <th width="15%">信息发布时间</th>
        <th width="10%">操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $course_information_id = $row['course_information_id'];
        $course_information_type = $row['course_information_type'];
        $course_information_title = $row['course_information_title'];
        $course_information_time = $row['course_information_time'];
        $course_id = $row['course_id'];

        $sql = "SELECT * from course WHERE course_id='$course_id'";
        $result_course = $pdo->query($sql);
        $course_name = "";
        if($row_course = $result_course->fetch()){
            $course_name = $row_course['course_name'];
        }

        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$course_information_id</td>
            <td>$course_name</td>
            <td>$course_information_type</td>
            <td>$course_information_title</td>
            <td>$course_information_time</td>
            <td><span class='am-badge am-badge-success'><a href='course_information_change.php?course_information_id=$course_information_id'>编辑</a></span> <span class='am-badge am-badge-danger'><a href='course_information_del.php?course_information_id=$course_information_id'>删除</a></span></td>
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