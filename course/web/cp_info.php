<?php
require_once '../admin/config.php';
require_once '../admin/functions.php';
$sql = "SELECT * FROM goods WHERE goods_id='" . $_GET['goods_id'] . "'";
$rs = $pdo->query($sql);
if ($row = $rs->fetch()) {
    $sql = "SELECT * FROM goods_category WHERE goods_category_id='" . $row['goods_category_id'] . "'";
    $rs = $pdo->query($sql);
    $row_category = $rs->fetch();

    $sql = "SELECT * FROM user WHERE user_id='" . $row['user_id'] . "'";
    $rs = $pdo->query($sql);
    $row_user = $rs->fetch();
}
else {
    header("lcation:index.php");
}
?>
<?php include 'header.php';?>
    <div class="shop" id="shop">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.php">首页</a></li>
              <li><a href="xyg.php?category_id=<?php echo $row['goods_category_id'];?>&page=1"><?php echo $row_category['goods_category_name'];?></a></li>
              <li class="active"><?php echo $row['goods_title'];?></li>
            </ol>
            <div class="row">
              <div class="col-lg-4" id="shop">
                <a href="#" class="thumbnail">
                <img src="<?php echo $row['goods_picture'].'?'.time();?>" alt="...">
                </a>
              </div>
              <div class="col-lg-8">
                <div class="row">
                  <div class="col-sm-2 text-right"><h4>标题：</h4></div>
                  <div class="col-sm-10"><h4><?php echo $row['goods_title'];?></h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-2 text-right"><h4>分类：</h4></div>
                  <div class="col-sm-10"><h4><a href="xyg.php?category_id=<?php echo $row['goods_category_id'];?>&page=1"><?php echo $row_category['goods_category_name'];?></a></h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-2 text-right"><h4>价格：</h4></div>
                  <div class="col-sm-10"><h4>￥<?php echo $row['goods_price'];?></h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-2 text-right"><h4>上传用户：</h4></div>
                  <div class="col-sm-10"><h4><?php echo $row_user['user_name'];?></h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="btn-group" role="group" aria-label="buy">
                      <?php
                      $goods_link = $row['goods_link'];
                      $goods_link = str_replace('http://', '', $goods_link);  //处理链接
                      $goods_link = str_replace('https://', '', $goods_link);  //处理链接
                      $goods_link = "http://$goods_link";
                      ?>
                    <a href="<?php echo$goods_link;?>" target="_blank"><button type="button" class="btn btn-default">立即购买</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">商品介绍</a></li>
              </ul>
              <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="info"><?php echo $row['goods_body'];?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php';?>
