<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/4
 * Time: 22:32
 */

session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';
@$course_id = $_POST['course_id'];
@$course_name = $_POST['course_name'];
if($course_id!=null&&$course_name!=null){
    $sql = "update course set course_name='$course_name' WHERE course_id = $course_id";
    if($result = $pdo->exec($sql)){
        echo "修改成功！";
    }else{
        echo "修改失败！";
    }
    $result=null;
    $pdo=null;
}
