<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$user_id = $_GET['user_id'];
$sql = "DELETE FROM user WHERE user_id='$user_id'";
$pdo->exec($sql);
$pdo =null;
header("location:user_list.php");
