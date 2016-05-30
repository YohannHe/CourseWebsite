<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$information_id = $_POST['information_id'];
$information_title = $_POST['information_title'];
$information_body = $_POST['information_body'];
require_once 'config.php';
require_once 'functions.php';

$sql = "UPDATE information SET information_title='$information_title',information_body='$information_body' WHERE information_id='$information_id'";
$pdo->exec($sql);
$pdo = null;
echo"修改成功";