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
            <li role="presentation"><a href="grxx.php">个人信息</a></li>
            <li role="presentation"><a href="xgzl.php">修改资料</a></li>
            <li role="presentation" class="active"><a href="xgmm.php">修改密码</a></li>
            <li role="presentation"><a href="cpgl.php" target="_blank">产品管理</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-sm-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">修改密码</h3></div>
            <div class="panel-body">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">原密码</div>
                  <input type="password" id="oldpassword" name="oldpassword" value="" placeholder="密码" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">密码</div>
                  <input type="password" id="password" name="password" value="" placeholder="密码" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">密码</div>
                  <input type="password" id="password2" name="password2" value="" placeholder="重复密码" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="panel-footer text-center">
              <button type="button" class="btn btn-primary">确认修改</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php';?>