<?php include 'header.php';?>
<script src="js/verify.js"></script>
    <div class="main" style="height: 80%">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-4">
            <?php
            if (!session_id()) session_start();
            @$user = $_SESSION['user'];
            if($user!=null){
              echo '<div class="panel panel-default panel-login">
              <div class="panel-body">
                 <div class="form-group">
                  <div class="input-group">';
                  $user = $_SESSION['user'];
                  echo '<p align="center">'.'欢迎回来,'.$user.'</p>';
              echo '
                  </div>
                </div>
              </div>
              <div class="panel-footer text-center">
                <div class="btn-group" role="group" aria-label="btn">
                  <a href="grxx.php"><button class="btn btn-default">个人中心</button></a>
                  <a href="logout.php"><button class="btn btn-primary">注销</button></a>
                </div>
              </div>
            </div>';
            }else{
             echo '<div class="panel panel-default panel-login">
                <form action="login.php?cmd=login" method="post">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">账号</div>
                      <input type="text" class="form-control" id="username" name="username" placeholder="账号">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">密码</div>
                      <input type="password" class="form-control" id="passwd" name="passwd" placeholder="密码">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">验证码</div>
                      <input type="text" class="form-control" name="verify" id="check_text" placeholder="验证码">
                    </div>
                    <div class="check_img" style="text-align: right;margin-top: 8px"><img  onclick="return reflsh()" id="verify" src="verify.php" alt="验证码"></div>
                  </div>
                </div>
                <input type="submit" id="submit_btn" style="display: none">
            </form>
                <div class="panel-footer text-center">
                  <div class="btn-group" role="group" aria-label="btn">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#RegModal">注册</button>
                   <button class="btn btn-primary" type="button" onclick="return checkText()">登陆</button>
                  </div>
                </div>
              </div>';
            }
            ?>
            <div class="panel panel-default panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="s1"></span>公告栏<span class="s2"></span></h3>
              </div>
              <div class="list-group">
                <?php
                include_once 'functions.php';
                $index = new Index();
                $item = $index->gonggao();
                foreach($item as $value){
                  ?>
                  <a href="detail.php?information_id=<?php echo $value['information_id']?>" class="list-group-item"><?php echo $value['information_title']?></a>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-9 col-sm-8">
            <div class="main_c">
              <img src="images/bg2.png">
              <a href="course_center.php" class="ct ct1">课程中心</a>
              <a href="xyg.php" class="ct ct2 ctf">校园购<br>平台</a>
              <a href="info.php?it=创业平台" class="ct ct3">创业平台</a>
              <a href="info.php?it=资源素材库" class="ct ct4">素材<br>资源库</a>
              <h1 class="logo2">宁波电子商务学院教学资源库</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade panel-login" id="RegModal" tabindex="-1" role="dialog" aria-labelledby="RegLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="RegLabel">注册账号</h4>
          </div>
          <div class="modal-body">
            <form action="user_add.php" method="post" onsubmit="return Regcheck()">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">用户名</div>
                  <input type="text" id="username" name="username" value="" placeholder="用户名" class="form-control">
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
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">姓名</div>
                  <input type="text" id="name" name="name" value="" placeholder="姓名" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">年龄</div>
                  <input type="number" id="age" name="age" value="" placeholder="年龄" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="sex">性别</label>
                <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-default active">
                    <input type="radio" name="sex" id="sex_1" autocomplete="off" value="男" checked> 男
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="sex" id="sex_1" autocomplete="off" value="女"> 女
                  </label>
                </div>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary">注册</button>
          </div>
          </form>

        </div>
      </div>
    </div>

<?php include 'footer.php';?>
