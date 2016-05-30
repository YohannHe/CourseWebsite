<meta charset="utf-8">
<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/17
 * Time: 14:28
 */
if(isset($_REQUEST['verify'])) {
    if (!session_id()) session_start();
    if (strtolower($_REQUEST['verify']) == strtolower($_SESSION['vcode'])) {

        include_once 'functions.php';
        if($_GET['cmd']=='login'){
            @$username = $_POST['username'];
            @$passwd = $_POST['passwd'];
            $index = new Index();
            if($index->login($username,$passwd)){
                if (!session_id()) session_start();
                $_SESSION['user']=$username;
                echo "<script>alert('登陆成功！')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }else{
                echo "<script>alert('用户名或密码错误！')</script>";
                echo "<script>window.location.href='index.php'</script>";
            };
        }else if($_GET['cmd']=='reg'){
            @$username = $_POST['username'];
            @$password = $_POST['password'];
            @$name = $_POST['name'];
            @$age = $_POST['age'];
            @$sex = $_POST['sex'];
            $index = new Index();
            $result  = $index->reg($username,$password,$name,$age,$sex);
            echo "<script>alert('$result')</script>";
            echo "<script>window.location.href='index.php'</script>";

        }

    } else {
        echo "<script>alert('验证码错误！')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}
?>



