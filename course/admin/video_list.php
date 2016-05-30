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

$sql = "SELECT * from video";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">视频ID</th>
        <th width="20%">视频课程</th>
        <th width="45%">视频标题</th>
        <th width="15%">视频发布时间</th>
        <th width="10%">操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $video_id = $row['video_id'];
        $video_title = $row['video_title'];
        $video_time = $row['video_time'];
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
            <td>$video_id</td>
            <td>$course_name</td>
            <td>$video_title</td>
            <td>$video_time</td>
            <td><span class='am-badge am-badge-success'><a href='video_change.php?video_id=$video_id'>编辑</a></span> <span class='am-badge am-badge-danger'><a href='video_del.php?video_id=$video_id'>删除</a></span></td>
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