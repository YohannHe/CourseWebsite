
<?php include 'header.php';?>
    <div class="shop">
      <div class="container">
        <div class="row">
          <div class="col-md-2 col-sm-3">
            <ul class="nav nav-pills nav-stacked">
                <?php 
                    require_once '../admin/config.php';
                    require_once '../admin/functions.php';

                    if (isset($_GET['category_id'])) {
                        $category_id = $_GET['category_id'];
                    }
                    else {
                        $category_id = 9999;
                        $_GET['page'] = 1;
                    }
                    $sql = "SELECT * FROM goods_category";
                    $rs = $pdo->query($sql);
                    foreach ($rs as $row) {
                        if ($category_id == 9999 || $category_id == $row['goods_category_id']) {
                ?>
                <li role="presentation" class="active">
                <a href="xyg.php?category_id=<?php echo $row['goods_category_id'];?>&page=1" alt=""><?php echo $row['goods_category_name'];?></a>
                </li>
                <?php
                            $sql = "SELECT * FROM goods WHERE goods_category_id='" . $row['goods_category_id'] . "'";
                            $rs = $pdo->query($sql);
                            $_SESSION['maxPage'] = max(1, ceil($rs->rowCount()/16));
                            $category_id = $row['goods_category_id'];
                        }
                        else {
                ?>
                <li role="presentation">
                <a href="xyg.php?category_id=<?php echo $row['goods_category_id'];?>&page=1" alt=""><?php echo $row['goods_category_name'];?></a>
                </li>
                <?php
                        }
                    }
                ?>
            </ul>
          </div>
          <div class="col-md-10 col-sm-9">
            <div class="row">
                <?php
                    $sql = "SELECT * FROM goods WHERE goods_category_id='$category_id' LIMIT " . ($_GET['page']-1)*16 . ", 16";
                    $rs = $pdo->query($sql);
                    while ($row = $rs->fetch()) {
                ?>
                <div class="col-md-3 col-sm-6">
                <a href="cp_info.php?goods_id=<?php echo $row['goods_id'];?>" class="thumbnail">
                    <img src="<?php echo $row['goods_picture'].'?'.time();?>" alt="">
                    <h4><?php echo $row['goods_title'];?></h4>
                    <p>￥<?php echo $row['goods_price'];?></p>
                    </a>
                </div>
                <?php }?>
            </div>
            <nav class="nav_page text-center">
              <ul class="pagination">
                <li>
                <a href="xyg.php?category_id=<?php echo $category_id;?>&page=<?php echo max($_GET['page']-1, 1) ;?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
<?php

?>
                <li><a href="xyg.php?category_id=<?php echo $category_id;?>&page=<?php echo $_GET['page'];?>"><?php echo $_GET['page'];?></a></li>
                <li>
                <a href="xyg.php?category_id=<?php echo $category_id;?>&page=<?php echo min($_GET['page']+1, $_SESSION['maxPage']);?>" aria-label="Next">
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
