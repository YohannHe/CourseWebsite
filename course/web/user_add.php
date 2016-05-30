<meta charset="utf-8">
<?php
@$username = $_POST['username'];
@$password = $_POST['password'];
@$name = $_POST['name'];
@$sex = $_POST['sex'];
@$age = $_POST['age'];

include_once 'functions.php';
$result = Index::reg($username,$password,$name,$age,$sex);
echo "<script>alert('".$result."')</script>";
echo "<script>window.location.href='index.php'</script>";
?>