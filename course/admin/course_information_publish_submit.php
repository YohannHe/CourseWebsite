<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$course_information_type = $_POST['course_information_type'];
$course_information_title = $_POST['course_information_title'];
$course_information_body = $_POST['course_information_body'];
$course_information_cover = "images/course_information_cover/default.png";
$course_name = $_POST['course_name'];
require_once 'config.php';
require_once 'functions.php';

date_default_timezone_set('Asia/Shanghai');
$course_information_time = date('Y-m-d H:i:s');
$sql = "SELECT * from course WHERE course_name='$course_name'";
$result = $pdo->query($sql);
if($row = $result->fetch()){
    $course_id = $row['course_id'];
}

$sql = "INSERT INTO course_information(course_information_type,course_information_title,course_information_body,course_information_time,course_id,course_information_cover) VALUES('$course_information_type','$course_information_title','$course_information_body','$course_information_time','$course_id','$course_information_cover')";
$pdo->exec($sql);

$course_information_id = $pdo ->lastInsertId();
if (!empty($_FILES['course_information_cover']['tmp_name'])) {  //如果选择了图片

    $file_image = $_FILES['course_information_cover'];
    $file_image_name = "images/course_information_cover/$course_information_id.png";  //图片文件名
    move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
    $sql = "UPDATE course_information SET course_information_cover='$file_image_name' WHERE course_information_id='$course_information_id'";  //把图片地址存入数据库
    $pdo->exec($sql);
}
$pdo = null;
echo"发布成功<br /><a href='course_information_publish.php'>返回</a>";