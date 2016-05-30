<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/5
 * Time: 19:12
 */


session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

$goods_category_name = $_POST['goods_category_name'];
if($goods_category_name!=null){
    require_once 'config.php';
    require_once 'functions.php';
    $sql = "SELECT * FROM goods_category WHERE goods_category_name='$goods_category_name'";
    $result = $pdo->query($sql);
    if($row = $result->fetch()){
        echo '分类已存在';
    }else{
        $sql = "INSERT INTO goods_category(goods_category_name)VALUE('$goods_category_name')";
        if($result = $pdo->exec($sql)){
            echo "添加成功";
        }else{
            echo "添加失败！";
        }
    }

}else{
    echo '没有参数';
    echo $goods_category_name;
}

$pdo=null;
