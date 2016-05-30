<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/amazeui.min.js"></script>
    <style>
        a{
            color: mintcream;
        }
    </style>
    <?php 
    require_once '../admin/config.php';
    require_once '../admin/functions.php';

    $sql = "SELECT * FROM goods WHERE goods_id='" . $_GET['goods_id'] . "'";
    if ($rs = $pdo->query($sql)) {
        $row = $rs->fetch();
        $goods_body = $row['goods_body'];
    }
    else {
        header("location:index.php");
    }
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#btn").on("click", function () {
            document.getElementById('goods_body').innerText=ue.getContent();
            document.getElementById("btn_submit").click();
            return false;
        });
    });
    </script>
    <script>
        var ue = UE.getEditor('editor');
        ue.ready(function() {
            ue.setContent('<?php echo"$goods_body"; ?>');
        });
    </script>

    <script>
        var ue = UE.getEditor('editor');
    </script>

</head>
<body>
<?php require_once 'header.php';?>
<form action="implement_cp_change.php" method="POST" class="am-form" enctype="multipart/form-data">
    <fieldset>
        <legend>商品添加</legend>

        <div class="am-form-group">
            <label for="doc-ipt-email-1">商品标题</label>
            <input type="text" name="goods_title" class="" id="doc-ipt-email-1" placeholder="输入商品标题" value="<?php echo $row['goods_title'];?>">
        </div>

        <div class="am-form-group">
            <label for="doc-ipt-email-1">商品链接</label>
            <input type="text" name="goods_link" class="" id="doc-ipt-email-1" placeholder="输入商品链接" value="<?php echo $row['goods_link'];?>">
        </div>

        <div class="am-form-group">
            <label for="doc-ipt-email-1">商品价格</label>
            <input type="text" name="goods_price" class="" id="doc-ipt-email-1" placeholder="输入商品价格" value="<?php echo $row['goods_price'];?>">
        </div>

        <div class="am-form-group">
            <label for="doc-select-1">请选择商品</label>
            <select name="goods_category_id" id="doc-select0">
                <?php
                $select_category_id = $row['goods_category_id'];

                require_once '../admin/config.php';
                require_once '../admin/functions.php';
                $sql = "SELECT * FROM goods_category";
                $rs = $pdo->query($sql);
                foreach ($rs as $row) {
                    if ($select_category_id == $row['goods_category_id']) {
                        echo "<option selected=\"selected\" value=\"" . $row['goods_category_id'] . "\">" . $row['goods_category_name'] . "</option>";
                    }
                    else {
                        echo "<option value=\"" . $row['goods_category_id'] . "\">" . $row['goods_category_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <span class="am-form-caret"></span>
        </div>

        <div class="am-form-group">
            <label for="doc-ipt-file-1">商品封面</label>
            <input type="file" name="goods_picture" id="doc-ipt-file-1" accept="image/*">
            <p class="am-form-help">请选择要上传的文件...</p>
        </div>

        <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>

        <p><button id="btn"  type="button" class="am-btn am-btn-default">提交</button></p>
        <input id="btn_submit" type="submit" style="display: none">
        <textarea id="goods_body" name="goods_body" style="display: none"></textarea>
        <input type="text" name="goods_id" value="<?php echo $_GET['goods_id'];?>" style="display: none">
        
    </fieldset>
</form>
<?php require_once 'footer.php';?>
</body>
</html>
