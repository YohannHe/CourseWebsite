
    <link href="css/list.css" rel="stylesheet">
    <style>
      ul{
        list-style: none;
      }
    </style>
  </head>
  <body>
  <?php
  require_once'header.php';
  include_once 'functions.php';
  ?>
  <?php
  @$it=$_GET['it'];
  if($it==null) $it='电商前沿';
  //分页处理
  $array = Information::getInf($it,-1);
  $page = ceil(sizeof($array) / 12);
  @$page_num = $_GET['page'];
  if ($page > 1) {
      if($page_num!=null){
          $num = ($page_num-1)*12;
          $array = Information::getInf($it,$num);
      }else{
          $array=null;
          $array = Information::getInf($it,0);
      }
  }
  ?>
    <div class="ec">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><?echo $it?></li>
            </ol>
          </div>
        </div>
        <div class="row" style="height: 530px">
            <div class="col-sm-3">
                <div class="panel panel-default panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="s1"></span>公告栏<span class="s2"></span></h3>
                    </div>
                    <div class="list-group">
                        <?php
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
          <div class="col-sm-9">
                    <div  id="conn" class="con media-list list-group-item" >
                        <ul>
                                <?php
                                foreach ($array as $value) { ?>
                                    <li><span><?php echo $value['information_time'] ?></span><a
                                            href="detail.php?information_id=<?php echo $value['information_id']?>"
                                            target="_blank"><?php echo $value['information_title'] ?></a></li>
                                <?php } ?>

                        </ul>
                    </div>
              <nav class="text-center nav_page" style="margin-top: 120px">
                  <ul class="pagination">
                      <li>

                              <a href="info.php?it=<?php echo $it ?>&page=<?php if($page_num-1>=1)echo $page_num-1;else echo 1;?>" aria-label="Previous">
                                  <span aria-hidden="true">上一页</span>
                              </a>
                      </li>
                      <li>

                              <a href="info.php?it=<?php echo $it ?>&page=<?php if($page_num==null)echo 2; else if($page_num+1<=$page)echo $page_num+1;else echo $page;?>" aria-label="Previous">
                                  <span aria-hidden="true">下一页</span>
                              </a>

                      </li>
                  </ul>
              </nav>
          </div>
        </div>
      </div>
    </div>
  <?php
  require_once'footer.php';
  ?>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>