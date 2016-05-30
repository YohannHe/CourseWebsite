<?php include 'header.php';?>
<?php
  if (!session_id()) session_start();
  if($_SESSION['user']!=null){
  $username = $_SESSION['user'];
  }else{
  header("location:index.php");
  }
  ?>
  <script>
    function btn_submit(){
      if(document.getElementById('name').value==''||document.getElementById('age').value==''){
        alert('请将信息填写完成！');
      }else {
        document.getElementById('submit_btn').click();
      }
    }
  </script>
  <div class="info">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="grxx.php">个人信息</a></li>
            <li role="presentation" class="active"><a href="xgzl.php">修改资料</a></li>
            <li role="presentation"><a href="xgmm.php">修改密码</a></li>
            <li role="presentation"><a href="cpgl.php" target="_blank">产品管理</a></li>
          </ul>
        </div>
        <?php
        include_once 'functions.php';
        $item = Grzx::grxx($username)
        ?>
        <div class="col-sm-6 col-sm-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">资料修改</h3></div>
            <form action="grzx_submit.php?cmd=xgzl" method="post">
            <div class="panel-body">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">姓名</div>
                  <input type="hidden" value="<?php echo $username?>" name="username">
                  <input type="text" id="name" name="name" value="<?php echo $item['user_name']?>" placeholder="姓名" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">年龄</div>
                  <input type="number" id="age" name="age" value="<?php echo $item['user_age']?>" placeholder="年龄" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="sex">性别</label>
                <div class="btn-group" data-toggle="buttons">
                  <?php
                    if($item['user_sex']=="男"){
                      ?>
                      <label class="btn btn-default active">
                        <input type="radio" name="sex" id="sex_1" autocomplete="off" value="男" checked>男
                      </label>
                      <label class="btn btn-default">
                        <input type="radio" name="sex" id="sex_1"   autocomplete="off" value="女">女
                      </label>
                      <?php
                    }else{
                      ?>
                      <label class="btn btn-default">
                        <input type="radio" name="sex" id="sex_1" autocomplete="off" value="男">男
                      </label>
                      <label class="btn btn-default active">
                        <input type="radio" name="sex" id="sex_1" autocomplete="off" value="女" checked> 女
                      </label>
                      <?php
                    }
                  ?>

                </div>
              </div>
            </div>
              <input type="submit" id="submit_btn" style="display: none">
            </form>
            <div class="panel-footer text-center">
              <button type="button" class="btn btn-primary" onclick="btn_submit()">确认修改</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php';?>