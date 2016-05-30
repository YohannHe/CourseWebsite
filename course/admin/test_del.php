<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$test_id = $_GET['test_id'];
$sql = "DELETE FROM test WHERE test_id='$test_id'";
$pdo->exec($sql);
$pdo = null;
header("location:test_list.php");
