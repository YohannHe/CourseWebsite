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
    session_start();
    if(isset($_SESSION['username'])){
        $teachername = $_SESSION['username'];
    }else{
        header("location:login/index.html");
    }

    require_once 'config.php';
    require_once 'functions.php';

    $course_information_id = $_GET['course_information_id'];
    $sql = "SELECT * from course_information WHERE course_information_id='$course_information_id'";
    $result = $pdo->query($sql);
    if($row = $result->fetch()) {
        $course_information_id = $row['course_information_id'];
        $course_information_title = $row['course_information_title'];
        $course_information_type = $row['course_information_type'];
        $course_information_body = $row['course_information_body'];
        $course_id = $row['course_id'];
    }
    ?>

    <script>
        var ue = UE.getEditor('editor');
        ue.ready(function() {
            ue.setContent('<?php echo"$course_information_body"; ?>');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn").on("click", function () {
                document.getElementById('course_information_body').innerText=ue.getContent();
                document.getElementById("btn_submit").click();
                return false;
            });
        });
    </script>
</head>
<body>
<form class="am-form" action="course_information_change_submit.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>课程信息修改</legend>

        <div class="am-form-group">
            <label for="doc-select-1">课程信息标题</label>
            <input type="text" class="" id="course_information_title" name="course_information_title" value="<?php echo"$course_information_title";?>" placeholder="课程信息标题">
        </div>

        <div class="am-form-group">
            <label for="doc-select-1">课程信息类型</label>
            <select id="course_information_type" name="course_information_type">
                <option><?php echo"$course_information_type";?></option>
                <?php
                if($course_information_type!= "课程大纲") echo"<option>课程大纲</option>";
                if($course_information_type!= "电子教材") echo"<option>电子教材</option>";
                if($course_information_type!= "教学课件") echo"<option>教学课件</option>";
                if($course_information_type!= "教学素材") echo"<option>教学素材</option>";
                ?>
            </select>
            <span class="am-form-caret"></span>
        </div>

        <div class="am-form-group">
            <label for="doc-select-1">课程名</label>
            <select id="course_information_tppe"  id="course_name" name="course_name">
                <?php
                require_once 'config.php';
                require_once 'functions.php';
                connectDB();
                $sql = "SELECT * from course WHERE course_id='$course_id'";
                $result = $pdo->query($sql);
                if($row = $result->fetch()){
                    $course_nameed = $row['course_name'];
                    echo"<option>$course_nameed</option>";
                }

                $sql = "SELECT * from course WHERE course_name!='$course_nameed'";
                $result = $pdo->query($sql);
                while($row = $result->fetch()){
                    $course_name = $row['course_name'];
                    echo"<option>$course_name</option>";
                }
                $pdo = null;
                ?>
            </select>
            <span class="am-form-caret"></span>
        </div>

        <div class="am-form-group">
            <label for="doc-ipt-file-1">课程信息封面(不上传为不修改)</label>
            <input type="file" id="course_information_cover" name="course_information_cover" accept="image/*">
            <p class="am-form-help">请选择要上传的文件...</p>
        </div>

        <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        <textarea id="course_information_body" name="course_information_body" style="display: none"></textarea>
        <p><button type="button" id="btn" class="am-btn am-btn-default">提交</button></p>
        <p><button type="submit" id="btn_submit" class="am-btn am-btn-default" style="display: none">提交</button></p>
        <input type="text" name="course_information_id" value="<?php echo"$course_information_id";?>" style="display: none">
    </fieldset>
</form>
</body>
</html>