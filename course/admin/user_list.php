<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
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

require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from user";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">用户ID</th>
        <th width="65%">用户账号</th>
        <th width="15%">用户姓名</th>
        <th>操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $user_id = $row['user_id'];
        $user_account = $row['user_account'];
        $user_name = $row['user_name'];
        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$user_id</td>
            <td>$user_account</td>
            <td>$user_name</td>
            <td><span class='am-badge am-badge-success'><a href='user_change.php?user_id=$user_id'>重置密码</a></span> <span class='am-badge am-badge-danger'><a href='user_del.php?user_id=$user_id'>删除</a></span></td>
        </tr>
        ";
        $i++;
    }
    $pdo = null;
    ?>
    </tbody>
</table>
</body>
</html>