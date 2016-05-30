<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$course_information_id = $_GET['course_information_id'];
$sql = "DELETE FROM course_information WHERE course_information_id='$course_information_id'";
$pdo->exec($sql);
$pdo = null;
header("location:course_information_list.php");
