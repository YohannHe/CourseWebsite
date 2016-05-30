<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$teacher_id = $_GET['teacher_id'];
$sql = "DELETE FROM teacher WHERE teacher_id='$teacher_id'";
$pdo->exec($sql);
$pdo =null;
header("location:teacher_list.php");
