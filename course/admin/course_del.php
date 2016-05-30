<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$course_id = $_GET['course_id'];
$sql = "DELETE FROM course WHERE course_id='$course_id'";
$pdo->exec($sql);
$pdo =null;
header("location:course_list.php");
