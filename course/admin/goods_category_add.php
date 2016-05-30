<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <meta charset="UTF-8">
    <title></title>
    <script>
        function tijiao(){
            var goods_category_name = document.getElementById('goods_category_name').value;
            if(goods_category_name=="") {
                alert("请填写分类")
            }else{
                document.getElementById('bt_submit').click();
            }
        }
    </script>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}
?>
<div class="am-g" style="margin-top: 20px">
    <div class="am-u-md-8 am-u-sm-centered">
        <form action="goods_category_add_submit.php" method="post" class="am-form">
            <fieldset class="am-form-set">
                <input name='goods_category_name' id="goods_category_name" type='text' placeholder='分类名'>
            </fieldset>
            <input type="submit" id="bt_submit" style="display: none">
            <button type="button" onclick="tijiao()" class="am-btn am-btn-primary am-btn-block">添加</button>
        </form>
    </div>
</div>
</body>
</html>
