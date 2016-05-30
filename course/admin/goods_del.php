<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$goods_id = $_GET['goods_id'];
$sql = "DELETE FROM goods WHERE goods_id='$goods_id'";
$pdo->exec($sql);
$pdo = null;
header("location:goods_list.php");
