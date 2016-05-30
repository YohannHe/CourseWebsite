<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>首页</title>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script>
        function info_main(src){  //修改元素的属性
            var index = document.getElementById("main");
            index.setAttribute("src",src);
        }
    </script>
</head>

<body>
<?php
session_start();
require_once '../config.php';
require_once '../functions.php';


define ('TOWARD_PAGE', '../index.php');
define ('BACKWARD_PAGE', 'index.html');

$username = $_POST['username'];
$password = $_POST['password'];
$regex = '/^[\w]{4,16}$/';

//echo "<script>{window.alert('" . $password . "');location.href = '" . BACKWARD_PAGE . "'}</script>";

if (preg_match($regex, $username) && preg_match($regex, $password)) {
    $sql = "SELECT * FROM admin WHERE admin_account = '$username' AND admin_password = '$password'";
    $result = $pdo->query($sql);

    if ($row = $result->fetch()) {
        $_SESSION['username'] = $username;
        header("Location: " . TOWARD_PAGE);
    }
}
$db = null;
echo "<script>{window.alert('账号或密码错误');location.href = '" . BACKWARD_PAGE . "'}</script>";
?>

</body>
</html>