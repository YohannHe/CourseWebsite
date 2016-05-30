<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div class="am-g" style="padding-top: 20px">
    <div class="am-u-md-8 am-u-sm-centered">
        <form action="course_change_submit.php" method="post" class="am-form">
            <fieldset class="am-form-set">
                <?php
                require_once 'config.php';
                require_once 'functions.php';
                $course_id = $_GET['course_id'];
                $sql = "SELECT * from course WHERE course_id='$course_id'";
                $result = $pdo->query($sql);
                if($row = $result->fetch()){
                    $course_name = $row['course_name'];
                }
                echo"<input name='course_name' value='$course_name' type='text' placeholder='课程名'>";
                echo"<input name='course_id' value='$course_id' type='hidden'>";
                $pdo = null;
                ?>
            </fieldset>
            <button type="submit" class="am-btn am-btn-primary am-btn-block">修改</button>
        </form>
    </div>
</div>
</body>
</html>
