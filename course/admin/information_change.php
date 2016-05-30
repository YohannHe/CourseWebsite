<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/amazeui.min.js"></script>

    <style type="text/css">
        div{
            width:100%;
        }
    </style>

    <?php
    $information_id = $_GET['information_id'];
    require_once 'config.php';
    require_once 'functions.php';

    $sql = "SELECT * from information WHERE information_id='$information_id'";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    $information_type = $row['information_type'];
    $information_title = $row['information_title'];
    $information_body = $row['information_body'];
    ?>

    <script>
        var ue = UE.getEditor('editor');
            ue.ready(function() {
                ue.setContent('<?php echo"$information_body"; ?>');
            });
    </script>

    <script type="text/javascript">
        var information_id = <?php echo"$information_id "; ?>;
        $(document).ready(function(){
            $("#btn").on("click", function () {
                var information_title = document.getElementById("information_title").value;
                if(information_title == ""){
                    alert("信息标题不能为空");
                }else{
                    $.post("information_change_submit.php",{information_id:information_id,information_title:information_title,information_body:ue.getContent()},function(data){
                        alert(data);
                        self.location='information_list.php?information_type=<?php echo"$information_type"; ?>';
                    });
                }
                return false;
            });
        });


    </script>
</head>
<body>
<form action="" method="post">
    <div>
        <br />
        <input id="information_title" name="information_title" type="text" value="<?php echo"$information_title";?>" placeholder="输入标题" style="width:100%;"><br /><br />
        <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        <button id="btn" type="button" class="am-btn am-btn-primary am-btn-block">保存</button>
    </div>

</form>
<?php
$pdo = null;
?>
</body>
</html>