<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/4
 * Time: 21:39
 */

session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
require_once 'config.php';
require_once 'functions.php';

@$user_id = $_POST['user_id'];
@$newPassword = $_POST['newPassword'];
if($newPassword!=null&&$user_id!=null){
    $sql = "update user set user_password=$newPassword WHERE user_id=$user_id";
    if($result = $pdo->exec($sql)){
        echo "重置成功！";
    }else{
        echo "重置失败！";
    }
    $result=null;
    $pdo=null;
}
