<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/amazeui.min.css"/>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    $teachername = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

?>
<div class="am-g">
    <div class="am-u-md-8 am-u-sm-centered">
        <form action="user_change_submit.php" method="post" class="am-form">
            <fieldset class="am-form-set">

                <label>
                    <?php
                    require_once 'config.php';
                    require_once 'functions.php';

                    $user_id = $_GET['user_id'];
                    $sql = "SELECT * from user WHERE user_id='$user_id'";
                    $result = $pdo->query($sql);
                    if($row = $result->fetch()){
                        $user_account = $row['user_account'];
                    }
                    echo"用户名:$user_account";
                    $pdo = null;
                    ?>
                </label>
                <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                <input name="newPassword" type="password" placeholder="新密码">
                <input name="againPassword" type="password" placeholder="确认新密码">
            </fieldset>
            <button type="submit" class="am-btn am-btn-primary am-btn-block">重置密码</button>
        </form>
    </div>
</div>
</body>
</html>
