<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/4
 * Time: 23:32
 */


session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

$teacher_name = $_POST['teacher_name'];
$teacher_positional = $_POST['teacher_positional'];
$teacher_job = $_POST['teacher_job'];
$teacher_department = $_POST['teacher_department'];
$teacher_body = $_POST['teacher_body'];


require_once 'config.php';
require_once 'functions.php';

$sql = "INSERT INTO teacher(teacher_name,teacher_positional,teacher_job,teacher_department,teacher_body)VALUES
 ('$teacher_name','$teacher_positional','$teacher_job','$teacher_department','$teacher_body')";

if($result=$pdo->exec($sql)){
    if (!empty($_FILES['teacher_picture']['tmp_name'])) {  //如果选择了图片
        $teacher_id = $pdo->lastInsertId();
        $file_image = $_FILES['teacher_picture'];
        $file_image_name = "images/teacher_images/$teacher_id.png";  //图片文件名
        move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
    }
    echo"添加成功<br /><a href='teacher_add.php'>返回</a>";
}else{
    echo"添加失败<br /><a href='teacher_add.php'>返回</a>";
}