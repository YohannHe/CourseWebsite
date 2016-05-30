<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$video_title = $_POST['video_title'];
$video_link = $_POST['video_body'];
$course_name = $_POST['course_name'];
require_once 'config.php';
require_once 'functions.php';

date_default_timezone_set('Asia/Shanghai');
$video_time = date('Y-m-d H:i:s');

$sql = "SELECT * from course WHERE course_name='$course_name'";
$result = $pdo->query($sql);
if($row = $result->fetch()){
    $course_id = $row['course_id'];
}

$sql = "INSERT INTO video(video_title,video_link,video_cover,video_time,course_id) VALUES('$video_title','$video_link','images/video_cover/default.png','$video_time','$course_id')";
$pdo->exec($sql);

$video_id = $pdo ->lastInsertId();
if (!empty($_FILES['video_cover']['tmp_name'])) {  //如果选择了图片

    $file_image = $_FILES['video_cover'];
    $file_image_name = "images/video_cover/$video_id.png";  //图片文件名
    move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
    $sql = "UPDATE video SET video_cover='$file_image_name' WHERE video_id='$video_id'";  //把图片地址存入数据库
    $pdo->exec($sql);
}

$pdo = null;
echo"发布成功<br /><a href='video_publish.php'>返回</a>";