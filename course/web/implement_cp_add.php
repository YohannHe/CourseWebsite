<meta charset="UTF-8">
<?php
session_start();
if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}
else{
    header("location:index.php");
}

$goods_title = htmlspecialchars($_POST['goods_title']);
$goods_link = htmlspecialchars($_POST['goods_link']);
$goods_price = htmlspecialchars($_POST['goods_price']);
$goods_category = $_POST['goods_category_id'];
$goods_picture = "images/goods/default.png";
$goods_body = $_POST['goods_body'];

require_once '../admin/config.php';
require_once '../admin/functions.php';

$sql = "SELECT * FROM user WHERE user_account='$username'";

if ($row = $pdo->query($sql)->fetch()) {
    $user_id = $row['user_id'];
}
else {
    header("location:index.php");
}


$sql = "INSERT INTO goods (goods_title, goods_link, goods_price, goods_category_id, goods_body, user_id,goods_picture) VALUES('$goods_title', '$goods_link', '$goods_price', '$goods_category', '$goods_body', '$user_id','$goods_picture')";
$rs = $pdo->exec($sql);
if ($rs) {
    $goods_id = $pdo ->lastInsertId();
    if (!empty($_FILES['goods_picture']['tmp_name'])) {
        $file_image = $_FILES['goods_picture'];
        $file_image_name = "images/goods/$goods_id.png";
        if (!move_uploaded_file($file_image['tmp_name'], $file_image_name)) {
            echo "<script>alert('图片上传失败')</script>";
        }
        $sql = "UPDATE goods SET goods_picture='$file_image_name' WHERE goods_id='$goods_id'";
        $pdo->exec($sql);
    }
    $pdo = null;
    echo "<script>{
    alert('添加成功.');
    location.href = 'cp_add.php'
    }</script>";
}
else {
    echo "<script>{
    alert('添加失败');location.href = 'cp_add.php'
    }</script>";
}
?>
