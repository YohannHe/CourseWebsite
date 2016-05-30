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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn").on("click", function () {
                var information_type = document.getElementById("information_type").value;
                var information_title = document.getElementById("information_title").value;
                if(information_type == "请选择发布版块") {
                    alert("请选择发布版块");
                }else if(information_title == ""){
                    alert("信息标题不能为空");
                }else{
                    $.post("information_publish_submit.php",{information_type:$("#information_type").val(),information_title:information_title,information_body:ue.getContent()},function(data){
                        alert(data);
                        self.location='information_publish.php';
                    });
                }
                return false;
            });
        });
    </script>
    <script>
        var ue = UE.getEditor('editor');
    </script>
</head>
<body>
<form action="" method="post">
    <div>
        <br />
        <select name="information_type" id="information_type">
            <option>请选择发布版块</option>
            <option>网站公告</option>
            <option>创业平台</option>
            <option>资源素材库</option>
            <option>电商前沿</option>
        </select><br /><br />
        <input  name="information_title" id="information_title" type="text" placeholder="输入标题" style="width:100%;"><br /><br />
        <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        <button id="btn" type="button" onclick="tijiao()" class="am-btn am-btn-primary am-btn-block">发布</button>
        <!--<input type="button"  id="btn" onclick="tijiao()" class="am-btn am-btn-primary am-btn-block">-->
    </div>
</form>

</body>
</html>