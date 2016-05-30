<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$course_information_id = $_POST['course_information_id'];
$course_information_title = $_POST['course_information_title'];
$course_information_type = $_POST['course_information_type'];
$course_information_body = $_POST['course_information_body'];
$course_name = $_POST['course_name'];
require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from course WHERE course_name='$course_name'";
$result = $pdo->query($sql);
if($row = $result->fetch()){
    $course_id = $row['course_id'];
}

$sql = "UPDATE course_information SET course_information_type='$course_information_type',course_id='$course_id',course_information_title='$course_information_title',course_information_body='$course_information_body' WHERE course_information_id='$course_information_id'";
$pdo->exec($sql);

if (!empty($_FILES['course_information_cover']['tmp_name'])) {  //如果选择了图片

    $file_image = $_FILES['course_information_cover'];
    $file_image_name = "images/course_information_cover/$course_information_id.png";  //图片文件名
    move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
    $sql = "UPDATE course_information SET course_information_cover='$file_image_name' WHERE course_information_id='$course_information_id'";  //把图片地址存入数据库
    $pdo->exec($sql);
}

$pdo = null;
echo"修改成功<a href='course_information_list.php'>返回</a>";