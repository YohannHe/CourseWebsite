<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
$username = $_SESSION['username'];
require_once 'config.php';
require_once 'functions.php';


define ('TOWARD_PAGE', 'admin_add.html');
define ('BACKWARD_PAGE', 'admin_add.html');

$adminUsername = $_POST['adminUsername'];
$password = $_POST['password'];
$againPassword = $_POST['againPassword'];
$regex = '/^[\w]{4,16}$/';

if (($password == $againPassword) && preg_match($regex, $adminUsername) && preg_match($regex, $password)) {
    $sql = "SELECT * FROM admin WHERE admin_id = 1 AND admin_account =  '$username'";
    $result = $pdo->query($sql);

    if ($row = $result->fetch()) {
        $sql = "SELECT * FROM admin WHERE admin_account = '$adminUsername'";
        $result = $pdo->query($sql);
        if ($row = $result->fetch()){
            die("<script>{window.alert('账号已存在');location.href = '" . BACKWARD_PAGE . "'}</script>");
        }
        else {
            $sql = "INSERT INTO admin (admin_account, admin_password) VALUES('$adminUsername', '$password')";

            if ($pdo->exec($sql)) die("<script>{window.alert('添加成功');location.href = '" . TOWARD_PAGE . "'}</script>");
        }
    }
}
$db = null;
echo "<script>{window.alert('请检查信息');location.href = '" . BACKWARD_PAGE . "'}</script>";
?>
