<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';


$video_id = $_GET['video_id'];
$video_type = $_GET['video_type'];
$sql = "DELETE FROM video WHERE video_id='$video_id'";
$pdo->exec($sql);
$pdo =null;
header("location:video_list.php?video_type=$video_type");
