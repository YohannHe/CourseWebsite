<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/5
 * Time: 16:36
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
$teacher_id = $_POST['teacher_id'];

require_once 'config.php';
require_once 'functions.php';

$sql = "UPDATE teacher set teacher_name='$teacher_name',teacher_positional='$teacher_positional',teacher_job='$teacher_job',teacher_department='$teacher_department',teacher_body='$teacher_body' WHERE teacher_id=$teacher_id";
if($result=$pdo->exec($sql)){
    echo "修改成功";
}else{
    if (!empty($_FILES['teacher_picture']['tmp_name'])) {  //如果选择了图片
        $file_image = $_FILES['teacher_picture'];
        $file_image_name = "images/teacher_images/$teacher_id.png";  //图片文件名
        move_uploaded_file($file_image['tmp_name'], $file_image_name);  //保存图片到服务器
        echo '修改成功';
    }else{
        echo"修改失败";
    }
}