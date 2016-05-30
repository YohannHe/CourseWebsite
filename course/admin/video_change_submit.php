<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$video_id = $_POST['video_id'];
$video_title = $_POST['video_title'];
$video_link = $_POST['video_link'];
require_once 'config.php';
require_once 'functions.php';

$sql = "UPDATE video SET video_title='$video_title',video_link='$video_link' WHERE video_id='$video_id'";
$pdo->exec($sql);
if (!empty($_FILES['video_cover']['tmp_name'])) {  //如果选择了图片

    $file_image = $_FILES['video_cover'];
    $file_image_name = "images/video_cover/$video_id.png";  //图片文件名
    move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
    $sql = "UPDATE video SET video_cover='$file_image_name' WHERE video_id='$video_id'"; ////把图片地址存入数据库
    $pdo->exec($sql);
}
$pdo = null;
echo"修改成功<br /><a href='video_list.php'>返回</a>";