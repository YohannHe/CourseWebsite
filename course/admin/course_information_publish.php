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
                var course_information_type = document.getElementById("course_information_type").value;
                var course_name = document.getElementById("course_name").value;
                var course_information_title = document.getElementById("course_information_title").value;
                if(course_name == "请选择发布课程"){
                    alert("请选择发布课程");
                }else if(course_information_type == "请选择课程类型") {
                    alert("请选择课程类型");
                }else if(course_information_title == ""){
                    alert("信息标题不能为空");
                }else{
                    document.getElementById('course_information_body').innerText=ue.getContent();
                    document.getElementById("btn_submit").click();
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
<form action="course_information_publish_submit.php" method="post" enctype="multipart/form-data">
    <div>
        <br />
        <select name="course_name" id="course_name">
            <option>请选择发布课程</option>
            <?php
            require_once 'config.php';
            require_once 'functions.php';

            $sql = "SELECT * from course";
            $result = $pdo->query($sql);
            while($row = $result->fetch()){
                $course_name = $row['course_name'];
                echo"<option>$course_name</option>";
            }
            $pdo = null;
            ?>
        </select>
        <select name="course_information_type" id="course_information_type">
            <option>请选择课程类型</option>
            <option>课程大纲</option>
            <option>电子教材</option>
            <option>教学课件</option>
            <option>教学素材</option>
        </select><br /><br />
        <div class="am-form-group">
            <label for="doc-ipt-file-1">封面图上传（不选择为默认）</label>
            <input name="course_information_cover" type="file" id="doc-ipt-file-1" accept="image/*">
            <p class="am-form-help">请选择要上传的文件...</p>
        </div>
        <input  name="course_information_title" id="course_information_title" type="text" placeholder="输入标题" style="width:100%;"><br /><br />
        <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        <button id="btn" type="button" onclick="tijiao()" class="am-btn am-btn-primary am-btn-block">发布</button>
        <input id="btn_submit" type="submit" style="display: none">
        <textarea id="course_information_body" name="course_information_body" style="display: none"></textarea>
    </div>
</form>

</body>
</html>