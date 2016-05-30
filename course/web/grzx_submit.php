<meta charset="utf-8">
<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/17
 * Time: 19:19
 */

@$cmd = $_GET['cmd'];
if($cmd=='xgzl'){
    include_once 'functions.php';
    @$name = $_POST['name'];
    @$age = $_POST['age'];
    @$sex = $_POST['sex'];
    @$username = $_POST['username'];
    if(Grzx::xgzl($username,$name,$age,$sex)){
        echo "<script>alert('修改成功！')</script>";
        echo "<script>window.location.href='xgzl.php'</script>";
    }else{
        echo "<script>alert('修改失败！')</script>";
        echo "<script>window.location.href='xgzl.php'</script>";
    }
}else if($cmd=='xgmm'){
    include_once 'functions.php';
    @$password = $_POST['password'];
    @$username = $_POST['username'];
    if(Grzx::xgmm($username,$name,$age,$sex)){
        echo "<script>alert('修改成功！')</script>";
        echo "<script>window.location.href='xgmm.php'</script>";
    }else{
        echo "<script>alert('修改失败！')</script>";
        echo "<script>window.location.href='xgmm.php'</script>";
    }
}
?>