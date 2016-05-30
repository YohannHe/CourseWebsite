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

$sql = "SELECT * from goods";
$result = $pdo->query($sql);
?>
<table class="am-table">
    <thead>
    <tr>
        <th width="10%">商品ID</th>
        <th width="50%">商品名称</th>
        <th width="10%">商品分类</th>
        <th width="10%">商品价格</th>
        <th width="10%">上传用户</th>
        <th width="10%">操作管理</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    while($row = $result->fetch()) {
        $goods_id = $row['goods_id'];
        $goods_title = $row['goods_title'];
        $goods_category_id = $row['goods_category_id'];
        $goods_price = $row['goods_price'];
        $user_id = $row['user_id'];

        $sql = "SELECT * from goods_category WHERE goods_category_id='$goods_category_id'";
        $result_goods_category = $pdo->query($sql);
        $goods_category_name = "";
        if($row_goods_category = $result_goods_category->fetch()){
            $goods_category_name = $row_goods_category['goods_category_name'];
        }

        $sql = "SELECT * from user WHERE user_id='$user_id'";
        $result_user = $pdo->query($sql);
        $user_name = "";
        if($row_user = $result_user->fetch()){
            $user_name = $row_user['user_name'];
        }

        if($i % 2 == 0) echo "<tr class='am-active'>";
        else echo"<tr>";
        echo "
            <td>$goods_id</td>
            <td>$goods_title</td>
            <td>$goods_category_name</td>
            <td>$goods_price</td>
            <td>$user_name</td>
            <td><span class='am-badge am-badge-danger'><a href='goods_del.php?goods_id=$goods_id'>删除</a></span></td>
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