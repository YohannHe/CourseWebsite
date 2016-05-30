<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/4
 * Time: 22:41
 */
session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

require_once 'config.php';
require_once 'functions.php';
@$course_name = $_POST['course_name'];

if($course_name!=null){
    $sql = "SELECT * from course WHERE course_name='$course_name'";
    $result = $pdo->query($sql);
    if($row = $result->fetch()){
        echo  "课程已存在,不要重复添加！";
    }
else{
        $sql = "INSERT INTO course(course_name) VALUES ('$course_name')";
        if($result=$pdo->exec($sql)){
            echo "添加成功！";
        }else{
            echo "添加失败！";
        }
    }
    $result = null;
    $pdo = null;
}
