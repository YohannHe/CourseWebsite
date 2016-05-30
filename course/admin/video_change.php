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
    $video_id = $_GET['video_id'];
    require_once 'config.php';
    require_once 'functions.php';

    $sql = "SELECT * from video WHERE video_id='$video_id'";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    $video_title = $row['video_title'];
    $video_link = $row['video_link'];
    ?>

    <script>
        var ue = UE.getEditor('editor');
        ue.ready(function() {
            ue.setContent('<?php echo"$video_link"; ?>');
        });
    </script>

    <script>
        var ue = UE.getEditor('editor');
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn").on("click", function () {
                var video_title = document.getElementById("video_title").value;
                var video_link = document.getElementById("video_link").value;
                if(video_title == ""){
                    alert("信息标题不能为空");
                }else if(video_link == ""){
                    alert("视频链接不能为空");
                }else{
                    document.getElementById("btn_submit").click();
                }
                return false;
            });
        });
    </script>
</head>
<body>
<form action="video_change_submit.php" method="post" enctype="multipart/form-data">
    <div>
        <br />

        <div class="am-form-group">
            <label for="doc-ipt-file-1">缩略图上传（不选择为默认）</label>
            <input name="video_cover" type="file" id="doc-ipt-file-1" accept="image/*">
            <p class="am-form-help">请选择要上传的文件...</p>
        </div>

        <input name="video_id" style="display: none" value="<?php echo"$video_id";?>">
        <input id="video_title" name="video_title" value="<?php echo"$video_title";?>" type="text" placeholder="输入视频标题" style="width:100%;"><br /><br />
        <input type="text" name="video_link" id="video_link" value="<?php echo"$video_link";?>" placeholder="输入视频链接" style="width:100%;"><br /><br />
        <button id="btn" type="button" class="am-btn am-btn-primary am-btn-block">发布</button>
        <button id="btn_submit" type="submit" style="display: none"></button>
    </div>
</form>
<?php
$pdo = null;
?>
</body>
</html>