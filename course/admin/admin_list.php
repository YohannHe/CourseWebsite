<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <meta charset="UTF-8">
    <title></title>
    <style>
        a{
            color: mintcream;
        }
    </style>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$admin_account = $_SESSION['username'];
require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from admin WHERE admin_account='$admin_account'";
$result = $pdo->query($sql);
$row = $result->fetch();
$admin_login_id = $row['admin_id'];
$sql = "SELECT * from admin";
$result = $pdo->query($sql);
?>
<ul class="am-list am-list-static am-list-border">
    <legend>管理员列表</legend>
    <?php
    while($row = $result->fetch()){
        $admin_id = $row['admin_id'];
        $admin_account = $row['admin_account'];
        echo"<li>";
        if($admin_login_id == 1){
            echo"<span class='am-badge am-badge-danger'><a href='admin_del.php?admin_id=$admin_id'>删除</a></span>";
        }
        echo "$admin_account";
        echo "</li>";
    }
    $pdo = null;
    ?>
</ul>
</body>
</html>