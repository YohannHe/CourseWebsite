<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/5
 * Time: 18:04
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
$test_link = str_replace('http://', '', $test_link);  //处理链接
$test_link = str_replace('https://', '', $test_link);  //处理链接
$test_link = "http://$test_link";
$test_type = $_POST['test_type'];
$course_name = $_POST['course_name'];
date_default_timezone_set('Asia/Shanghai');
$test_time = date('Y-m-d H:i:s');
$sql = "SELECT course_id FROM course WHERE course_name='$course_name'";
$result = $pdo->query($sql);
if($row = $result->fetch()){
    $course_id = $row['course_id'];
    $sql = "SELECT * FROM test WHERE test_title='$test_title'";
    $result = $pdo->query($sql);
    if($row = $result->fetch()){
        echo '测试标题重复!';
    }else{
        $sql = "INSERT INTO test(test_title,test_link,test_type,course_id,test_time)VALUES('$test_title','$test_link','$test_type','$course_id','$test_time')";
        if($result = $pdo->exec($sql)){
            echo '添加成功';
        }else{
            echo "添加失败";
        }
    }
}else{
    echo "课程不存在！";
}

$pdo =null;