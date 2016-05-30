<?php include 'header.php';?>
<?php
@$cit=$_GET['cit'];
@$cid=$_GET['cid'];
if($cit==null) $cit='kcdg';
switch ($cit){
  case 'kcdg';
        $name='课程大纲';
        break;
  case 'dzjc';
        $name='电子教材';
        break;
  case 'jxkj';
        $name='教学课件';
        break;
  case 'jxsc';
        $name='教学素材';
        break;
  case 'jxsp';
        $name='教学视频';
}
include_once 'functions.php';
if($cit=='jxsp'){
  $array = Main::getVideo($cid,-1);
}else{
  $array = Main::get($cid,$name,-1);
}
//分页处理
$page = ceil(sizeof($array) / 12);
@$page_num = $_GET['page'];
if ($page > 1) {
  if($page_num!=null){
    $num = ($page_num-1)*12;
    if($cit=='jxsp'){
      $array = Main::getVideo($cid,$num);
    }else{
      $array = Main::get($cid,$name,$num);
    }
  }else{
    if($cit=='jxsp'){
      $array = Main::getVideo($cid,0);
    }else{
      $array = Main::get($cid,$name,0);
    }
  }
}
$array_Course = Main::getCourse();
?>
    <div class="course">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><?php echo $name?></li>
              <li class="active"><?php echo Main::getCourseName($cid)['course_name']?></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading"><h3 class="panel-title"><?php echo $name?></h3></div>
              <div class="list-group">
                <?php
                if($cid==null) {
                  ?>
                  <a href="main.php?cit=<?php echo $cit?>" class="list-group-item active">全部</a>
                  <?php
                }else{
                  ?>
                  <a href="main.php?cit=<?php echo $cit?>" class="list-group-item">全部</a>
                  <?php
                }
                  foreach($array_Course as $value){
                    if( $value['course_id']==$cid){
                      ?>
                      <a href="main.php?cid=<?php echo $value['course_id']?>&cit=<?php echo $cit?>" class="list-group-item active"><?php echo Main::getCourseName($value['course_id'])['course_name']?></a>
                      <?php
                    }else{
                      $course_id=$value['course_id'];
                      ?>
                      <a href="main.php?cid=<?php echo $course_id?>&cit=<?php echo $cit?>" class="list-group-item"><?php echo Main::getCourseName($course_id)['course_name']?></a>
                      <?php
                    }
                  }
                ?>

              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="row courses">
              <?php
              if($cit=='jxsp'){
                  ?>
                  <?php
                  foreach($array as $value) {
                    $video_link = $value['video_link'];
                    $video_link = str_replace('http://', '', $video_link);  //处理链接
                    $video_link = str_replace('https://', '', $video_link);  //处理链接
                    $video_link = "http://$video_link";
                    ?>
                    <div class="col-xs-6 col-md-3">
                      <a href="<?php echo $video_link?>" class="thumbnail">
                        <img src="<?php if($value['video_cover']!=null) echo '../admin/'.$value['video_cover']; else echo '../admin/images/video_cover/default.png'?>" alt="">
                        <h5><?php echo $value['video_title']?></h5>
                      </a>
                    </div>
                  <?php }?>
                  <?php
              }else{
                  ?>
                  <?php
                  foreach($array as $value) {?>
                    <div class="col-xs-6 col-md-3">
                      <a target="_blank" href="detail.php?ciid=<?php echo $value['course_information_id']?>" class="thumbnail">
                        <img src="<?php if($value['course_information_cover']!=null) echo '../admin/'.$value['course_information_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                        <h5><?php echo $value['course_information_title']?></h5>
                      </a>
                    </div>
                  <?php }}?>
            </div>
            <nav class="text-center nav_page">
              <ul class="pagination">
                <li>
                  <?php
                  if($cid==null){
                    ?>
                    <a href="main.php?cit=<?php echo $cit ?>&page=<?php if($page_num-1>=1)echo $page_num-1;else echo 1;?>" aria-label="Previous">
                      <span aria-hidden="true">上一页</span>
                    </a>
                    <?php
                  }else{
                    ?>
                    <a href="main.php?cit=<?php echo $cit ?>&cid=<?php echo $cid ?>&page=<?php if($page_num-1>=1)echo $page_num-1;else echo 1;?>" aria-label="Next">
                      <span aria-hidden="true">上一页</span>
                    </a>
                    <?php
                  }
                  ?>
                </li>
                <li>
                  <?php
                  if($cid==null){
                    ?>
                    <a href="main.php?cit=<?php echo $cit ?>&page=<?php if($page_num==null)echo 2; else if($page_num+1<=$page)echo $page_num+1;else echo $page;?>" aria-label="Previous">
                      <span aria-hidden="true">下一页</span>
                    </a>
                    <?php
                  }else{
                    ?>
                    <a href="main.php?cit=<?php echo $cit ?>&cid=<?php echo $cid ?>&page=<?php if($page_num==null)echo 2; else if($page_num+1<=$page)echo $page_num+1;else echo $page;?>" aria-label="Next">
                      <span aria-hidden="true">下一页</span>
                    </a>
                    <?php
                  }
                  ?>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

<?php include 'footer.php';?>