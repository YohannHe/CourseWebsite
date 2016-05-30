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
$information_type=$_GET['information_type'];
echo "信息列表>>$information_type";
require_once 'config.php';
require_once 'functions.php';

$sql = "SELECT * from information WHERE information_type='$information_type'";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">信息ID</th>
        <th width="65%">信息标题</th>
        <th width="15%">信息发布时间</th>
        <th>操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $information_id = $row['information_id'];
        $information_title = $row['information_title'];
        $information_time = $row['information_time'];
        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$information_id</td>
            <td>$information_title</td>
            <td>$information_time</td>
            <td><span class='am-badge am-badge-success'><a href='information_change.php?information_id=$information_id'>编辑</a></span> <span class='am-badge am-badge-danger'><a href='information_del.php?information_id=$information_id&information_type=$information_type'>删除</a></span></td>
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