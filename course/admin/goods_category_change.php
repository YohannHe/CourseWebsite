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
<div class="am-g" style="padding-top: 20px">
    <div class="am-u-md-8 am-u-sm-centered">
        <form action="goods_category_change_submit.php" method="post" class="am-form">
            <fieldset class="am-form-set">
                <?php
                require_once 'config.php';
                require_once 'functions.php';
                $goods_category_id = $_GET['goods_category_id'];
                $sql = "SELECT * from goods_category WHERE goods_category_id='$goods_category_id'";
                $result = $pdo->query($sql);
                if($row = $result->fetch()){
                    $goods_category_name = $row['goods_category_name'];
                }
                echo"<input name='goods_category_name' id='goods_category_name' value='$goods_category_name' type='text' placeholder='分类名'>";
                $pdo = null;
                ?>
            </fieldset>
            <input type="hidden" value="<?php echo $goods_category_id?>" name="goods_category_id">
            <input type="submit" id="bt_submit" style="display: none">
            <button type="button" onclick="tijiao()" class="am-btn am-btn-primary am-btn-block">修改</button>
        </form>
    </div>
</div>
</body>
</html>
