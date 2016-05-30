<?php
require_once 'config.php';
require_once 'functions.php';

session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

$admin_id = $_GET['admin_id'];
$sql = "DELETE FROM admin WHERE admin_id='$admin_id'";
$pdo->exec($sql);
$pdo = null;
header("location:admin_list.php");
