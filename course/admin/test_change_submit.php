<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/5
 * Time: 18:48
 */


session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}


require_once 'config.php';
require_once 'functions.php';

$test_title = $_POST['test_title'];
$test_link = $_POST['test_link'];
$test_type = $_POST['test_type'];
$course_name = $_POST['course_name'];
date_default_timezone_set('Asia/Shanghai');
$test_time = date('Y-m-d H:i:s');
$test_id = $_POST['test_id'];
$sql = "SELECT course_id FROM course WHERE course_name='$course_name'";
$result = $pdo->query($sql);
if($row = $result->fetch()){

        $course_id = $row['course_id'];
        $sql = "UPDATE test set test_title='$test_title',test_link='$test_link',test_type='$test_type',course_id='$course_id',test_time='$test_time' WHERE test_id=$test_id";
        if($result = $pdo->exec($sql)){
            echo '修改成功';
        }else{
            echo "修改失败";
        }
}else{
    echo "课程不存在！";
}

$pdo =null;