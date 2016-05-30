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


define ('TOWARD_PAGE', 'password_change.html');
define ('BACKWARD_PAGE', 'password_change.html');

$oldPassword = htmlspecialchars($_POST['oldPassword']);
$newPassword = htmlspecialchars($_POST['newPassword']);
$againPassword = htmlspecialchars($_POST['againPassword']);
$regex = '/^[\w]{4,16}$/';

if (($newPassword == $againPassword) && preg_match($regex, $oldPassword) && preg_match($regex, $newPassword)) {
    $sql = "SELECT * FROM admin WHERE admin_account = '$username' AND admin_password = '$oldPassword'";
    $result = $pdo->query($sql);

    if ($row = $result->fetch()) {
        $result = null;
        $sql = "UPDATE admin SET admin_password = '$newPassword' WHERE admin_account = '$username'";
        if ($pdo->exec($sql)){
            $pdo = null;
            echo "<script>{window.alert('密码修改成功');location.href = '" . TOWARD_PAGE . "'}</script>";
        }
    }else{
        echo "<script>{window.alert('原密码错误');location.href = '" . BACKWARD_PAGE . "'}</script>";
    }
} else{
    echo "<script>{window.alert('请检查信息是否正确');location.href = '" . BACKWARD_PAGE . "'}</script>";
}
$pdo = null;
?>
