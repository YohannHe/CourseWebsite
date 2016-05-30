<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$information_type = $_POST['information_type'];
$information_title = $_POST['information_title'];
$information_body = $_POST['information_body'];
require_once 'config.php';
require_once 'functions.php';

date_default_timezone_set('Asia/Shanghai');
$information_time = date('Y-m-d H:i:s');

$sql = "INSERT INTO information(information_type,information_title,information_body,information_time) VALUES('$information_type','$information_title','$information_body','$information_time')";
$pdo->exec($sql);
$pdo = null;
echo"发布成功";