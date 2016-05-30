<meta charset="UTF-8">
<?php
session_start();
if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}
else{
    header("location:index.php");
}

require_once '../admin/config.php';
require_once '../admin/functions.php';

$goods_id = $_POST['goods_id'];
$sql = "SELECT * FROM goods WHERE goods_id='$goods_id'";
if ($row = $pdo->query($sql)->fetch()) {
    $goods_picture = $row['goods_picture'];
}
else {
    $goods_picture = "images/goods/default.png";
}

$goods_title = htmlspecialchars($_POST['goods_title']);
$goods_link = htmlspecialchars($_POST['goods_link']);

$goods_category = $_POST['goods_category_id'];
$goods_body = $_POST['goods_body'];
 if (!empty($_FILES['goods_picture']['tmp_name'])) {
        $file_image = $_FILES['goods_picture'];
        $file_image_name = "images/goods/$goods_id.png";
	$goods_picture =  $file_image_name;
        if (!move_uploaded_file($file_image['tmp_name'], $file_image_name)) {
            echo "<script>alert('上传失败');</script>";
        }
        $sql = "UPDATE goods SET goods_picture='$file_image_name' WHERE goods_id='$goods_id'";
        $pdo->exec($sql);
    }
$goods_price = $_POST['goods_price'];
$sql = "UPDATE goods SET goods_title='$goods_title', goods_link='$goods_link', goods_price='$goods_price', goods_category_id='$goods_category',  goods_body='$goods_body' WHERE goods_id='$goods_id'";
$rs = $pdo->exec($sql);
//    $goods_id = $pdo ->lastInsertId();
   
    $pdo = null;
    echo "<script>{
    alert('修改完成!');
    location.href = 'cpgl.php'
    }</script>";
?>

