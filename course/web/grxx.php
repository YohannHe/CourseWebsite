<?php include 'header.php';?>
<?php
if (!session_id()) session_start();
if($_SESSION['user']!=null){
  $username = $_SESSION['user'];
}else{
  header("location:index.php");
}
?>
  <div class="info">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="grxx.php">个人信息</a></li>
            <li role="presentation"><a href="xgzl.php">修改资料</a></li>
            <li role="presentation"><a href="xgmm.php">修改密码</a></li>
            <li role="presentation"><a href="cpgl.php" target="_blank">产品管理</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-sm-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">个人信息</h3></div>
            <div class="panel-body">
              <?php
                include_once 'functions.php';
                $grzx = new Grzx();
                $item = $grzx->grxx($username)
              ?>
              <p>用户名：<?php echo $item['user_account']?></p>
              <p>姓名：<?php echo $item['user_name']?></p>
              <p>年龄：<?php echo $item['user_age']?></p>
              <p>性别：<?php echo $item['user_sex']?></p>
              <p>注册时间：<?php echo $item['register_time']?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php';?>