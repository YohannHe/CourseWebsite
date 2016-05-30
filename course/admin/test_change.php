<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <style>
        a{
            color: mintcream;
        }
    </style>
    <script>
        function tijiao(){
            var test_title = document.getElementById('test_title').value;
            var test_link = document.getElementById('test_link').value;
            if(test_link==""||test_title==""){
                alert("请将信息填写完整！");
            }else{
                document.getElementById('bt_submit').click();
            }

            return false;
        }
    </script>
</head>
<body>
<?php
require_once 'config.php';
require_once 'functions.php';

$test_id = $_GET['test_id'];
$sql = "SELECT * from test WHERE test_id='$test_id'";
$result = $pdo->query($sql);
if($row = $result->fetch()) {
    $test_id = $row['test_id'];
    $test_title = $row['test_title'];
    $test_link = $row['test_link'];
    $test_type = $row['test_type'];
    $course_id = $row['course_id'];
}
?>
<form class="am-form" action="test_change_submit.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>试题发布</legend>

        <div class="am-form-group">
            <input type="text" class="" id="test_title" name="test_title" value="<?php echo"$test_title";?>" placeholder="试题标题">
        </div>

        <div class="am-form-group">
            <input type="text" class="" id="test_link" name="test_link" value="<?php echo"$test_link";?>" placeholder="试题链接">
        </div>

        <div class="am-form-group">
            <label for="doc-select-1">评测类型</label>
            <select id="test_type" name="test_type">
                <?php
                if($test_type == "自测系统"){
                    echo"
                        <option>自测系统</option>
                        <option>考试系统</option>
                    ";
                }else{
                    echo"
                        <option>考试系统</option>
                        <option>自测系统</option>

                    ";
                }
                ?>
            </select>
            <span class="am-form-caret"></span>
        </div>

        <div class="am-form-group">
            <label for="doc-select-1">评测科目</label>
            <select id="course_name" name="course_name">
                <?php
                session_start();
                if(isset($_SESSION['username'])){
                    $teachername = $_SESSION['username'];
                }else{
                    header("location:login/index.html");
                }
                require_once 'config.php';
                require_once 'functions.php';
                $sql = "SELECT * from course WHERE course_id='$course_id'";
                $result = $pdo->query($sql);
                if($row = $result->fetch()){
                    $course_name = $row['course_name'];
                    echo"<option>$course_name</option>";
                }

                $sql = "SELECT * from course WHERE course_name!='$course_name'";
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
        <input type="hidden" name="test_id" value="<?php echo $test_id?>" style="display: none">
        <input type="submit" id="bt_submit" style="display: none">
        <p><button type="button" onclick="tijiao()" class="am-btn am-btn-default">提交</button></p>
    </fieldset>
</form>
</body>
</html>