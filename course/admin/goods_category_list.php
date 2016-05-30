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

$sql = "SELECT * from goods_category";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">分类ID</th>
        <th width="77%">分类名称</th>
        <th width="13%">操作管理 <span class='am-badge am-badge-success'><a href="goods_category_add.php">添加分类</a></span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $goods_category_id = $row['goods_category_id'];
        $goods_category_name = $row['goods_category_name'];
        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$goods_category_id</td>
            <td>$goods_category_name</td>
            <td><span class='am-badge am-badge-success'><a href='goods_category_change.php?goods_category_id=$goods_category_id'>修改</a></span> <span class='am-badge am-badge-danger'><a href='goods_category_del.php?goods_category_id=$goods_category_id'>删除</a></span></td>
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