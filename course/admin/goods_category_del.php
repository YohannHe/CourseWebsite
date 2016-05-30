<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$goods_category_id = $_GET['goods_category_id'];
$sql = "DELETE FROM goods_category WHERE goods_category_id='$goods_category_id'";
$pdo->exec($sql);
$pdo = null;
header("location:goods_category_list.php");
