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
    <style>
        a{
            color: mintcream;
        }
    </style>
    <script>
        var ue = UE.getEditor('editor');
        function tijiao() {
            var teacher_name = document.getElementById("teacher_name").value;
            var teacher_positional = document.getElementById("teacher_positional").value;
            var teacher_job = document.getElementById("teacher_job").value;
            var teacher_department = document.getElementById("teacher_department").value;
            if (teacher_name == "" || teacher_positional == "" || teacher_job == "" || teacher_department == "") {
                alert("请将信息填写完整！")
            } else {
                document.getElementById('teacher_body').innerText = ue.getContent();
                document.getElementById("bt_submit").click();
            }

        }
    </script>

</head>
<body>
<form class="am-form" id="teacher" action="teacher_add_submit.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>添加教师</legend>

        <div class="am-form-group">
            <input type="text" class="" id="teacher_name" name="teacher_name" placeholder="教师姓名">
        </div>

        <div class="am-form-group">
            <input type="text" class="" id="teacher_positional" name="teacher_positional" placeholder="教师职称（例如：教授，副教授）">
        </div>

        <div class="am-form-group">
            <input type="text" class="" id="teacher_job" name="teacher_job" placeholder="教师职位（例如：班主任）">
        </div>

        <div class="am-form-group">
            <input type="text" class="" id="teacher_department" name="teacher_department" placeholder="教师所在系">
        </div>


        <div class="am-form-group">
            <label for="doc-ipt-file-1">教师照片</label>
            <input type="file" id="teacher_picture" name="teacher_picture" accept="image/*">
            <p class="am-form-help">请选择要上传的文件...</p>
        </div>

        <div class="am-form-group">
            <label for="doc-ta-1">教师简介</label>
            <textarea id="teacher_body" name="teacher_body" style="display: none" ></textarea>
            <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        </div>
    </fieldset>
    <input id="bt_submit" type="submit" style="display: none">
</form>
<p><button onclick="tijiao()" class="am-btn am-btn-default">提交</button></p>
</body>
</html>