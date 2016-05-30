<meta charset="UTF-8">
<?php
session_start();
if(isset($_SESSION['user']) && isset($_GET['goods_id'])){
    $username = $_SESSION['user'];
    require_once '../admin/config.php';
    require_once '../admin/functions.php';

    $sql = "DELETE FROM goods WHERE goods_id=" . $_GET['goods_id'];
    if ($pdo->exec($sql)) {
        echo "<script>{
        alert('删除成功!');
        location.href='cpgl.php';
        }</script>";
    }
    else {
        echo "<script>{
        alert('删除失败!');
        location.href='cpgl.php';
        }</script>";
    }
}
else{
    header("location:index.php");
}
?>
