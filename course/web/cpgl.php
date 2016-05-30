<?php
session_start();
if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}
else{
    header("location:index.php");
}
?>
<?php include 'header.php';?>
    <div class="product">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-right tool">
            <a href="cp_add.php"><button class="btn btn-default">上传产品</button></a>
          </div>
        </div>
        <div class="row">
            <?php
            require_once '../admin/config.php';
            require_once '../admin/functions.php';

            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
                $sql = "SELECT * FROM goods, user WHERE user.user_account='$username' AND goods.user_id = user.user_id";
                $rs = $pdo->query($sql);
                $rowCount = $rs->rowCount();
                $_SESSION['maxPage'] = max(1, ceil($rowCount/16));
            }

            $sql = "SELECT * FROM goods, user WHERE user.user_account='$username' AND goods.user_id = user.user_id LIMIT " . ($_GET['page']-1)*16 . ", 16";
            $rs = $pdo->query($sql);
            foreach($rs as $row) {
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                <img src="<?php echo $row['goods_picture'].'?'.time();?>" alt="">
                    <div class="caption">
                    <h3><?php echo $row['goods_title'];?></h3>
                        <div class="text-center">
                            <div class="btn-group" role="group" aria-label="edit">
                            <a href="cp_change.php?goods_id=<?php echo $row['goods_id'];?>">
                                <button type="button" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑</button></a>
                            <a href="cp_delete.php?goods_id=<?php echo $row['goods_id'];?>">
                                <button type="button" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <nav class="nav_page text-center">
              <ul class="pagination">
                <li>
                  <a href="cpgl.php?page=<?php echo max($_GET['page']-1, 1) ;?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a href="#"><?php echo $_GET['page'];?></a></li>
                <li>
                  <a href="cpgl.php?page=<?php echo min($_GET['page']+1, $_SESSION['maxPage']) ;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php';?>
