<?php include 'header.php';?>
<?php
  include_once 'functions.php';
  @$cid = $_GET['cid'];
  @$cit = $_GET['cit'];
  if($cid==null) $cid=1;
  $course_name = Course::getCourseName($cid);
//分页处理
$init = 0;
$page = 0;
if($cit!=null){
  if($cit=='教学视频'){
    $array = Course::getVideo($cid);
    if(sizeof($array)>12) {
      $page = ceil(sizeof($array) / 12);
      for ($i = 1; $i <= $page; $i++) {
        for ($j = $init; $j < sizeof($array); $j++) {
          $init++;
          $page_array[$i][] = $array[$j];
          if($init%12==0) break;
        }
      }
    }
  }else{
    $array = Course::get($cid,$cit);
    if(sizeof($array)>12) {
      $page = ceil(sizeof($array) / 12);
      for ($i = 1; $i <= $page; $i++) {
        for ($j = $init; $j < sizeof($array); $j++) {
          $init++;
          $page_array[$i][] = $array[$j];
          if($init%12==0) break;
        }
      }
    }
  }
}else{
  $array = Course::get($cid,$cit);
  if(sizeof($array)>12) {
    $page = ceil(sizeof($array) / 12);
    for ($i = 1; $i <= $page; $i++) {
      for ($j = $init; $j < sizeof($array); $j++) {
        $init++;
        $page_array[$i][] = $array[$j];
        if($init%12==0) break;
      }
    }
  }
}


@$page_num=$_GET['page'];
?>
    <div class="course">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><?php echo $course_name?></li>
              <li class="active"><?php echo $cit?></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading"><h3 class="panel-title"><?php echo $course_name?></h3></div>
              <div class="list-group">
                <a href="course.php?cid=<?php echo $cid;?>" class="list-group-item <?php if($cit==null) echo 'active'?>">全部</a>
                <a href="course.php?cid=<?php echo $cid;?>&cit=<?php echo '课程大纲'?>" class="list-group-item<?php if($cit=='课程大纲') echo ' active'?>">课程大纲</a>
                <a href="course.php?cid=<?php echo $cid;?>&cit=<?php echo '电子教材'?>" class="list-group-item<?php if($cit=='电子教材') echo ' active'?>">电子教材</a>
                <a href="course.php?cid=<?php echo $cid;?>&cit=<?php echo '教学课件'?>" class="list-group-item<?php if($cit=='教学课件') echo ' active'?>">教学课件</a>
                <a href="course.php?cid=<?php echo $cid;?>&cit=<?php echo '教学视频'?>" class="list-group-item<?php if($cit=='教学视频') echo ' active'?>">教学视频</a>
                <a href="course.php?cid=<?php echo $cid;?>&cit=<?php echo '教学素材'?>" class="list-group-item<?php if($cit=='教学素材') echo ' active'?>">教学素材</a>
              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="row courses" >
              <?php
              if($cit=='教学视频'){
                if($init==0){
                  ?>
                  <?php
                  foreach($array as $value) {
                    $video_link = $value['video_link'];
                    $video_link = str_replace('http://', '', $video_link);  //处理链接
                    $video_link = str_replace('https://', '', $video_link);  //处理链接
                    $video_link = "http://$video_link";
                    ?>
                    <div class="col-xs-6 col-md-3">
                      <a target="_blank" href="<?php echo $video_link?>" class="thumbnail">
                        <img src="<?php if($value['video_cover']!=null) echo '../admin/'.$value['video_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                        <h5><?php echo $value['video_title']?></h5>
                      </a>
                    </div>
                  <?php }?>
                  <?php
                }else{
                  @$page_num=$_GET['page'];
                  if($page_num!=null){
                    foreach($page_array[$page_num] as $value){
                      $video_link = $value['video_link'];
                      $video_link = str_replace('http://', '', $video_link);  //处理链接
                      $video_link = str_replace('https://', '', $video_link);  //处理链接
                      $video_link = "http://$video_link";
                      ?>
                      <div class="col-xs-6 col-md-3">
                        <a href="<?php echo $video_link?>" class="thumbnail">
                          <img src="<?php if($value['video_cover']!=null) echo '../admin/'.$value['video_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                          <h5><?php echo $value['video_title']?></h5>
                        </a>
                      </div>
                      <?php
                    }
                  }else{
                    foreach($page_array[1] as $value){
                      $video_link = $value['video_link'];
                      $video_link = str_replace('http://', '', $video_link);  //处理链接
                      $video_link = str_replace('https://', '', $video_link);  //处理链接
                      $video_link = "http://$video_link";
                      ?>
                      <div class="col-xs-6 col-md-3">
                        <a href="<?php echo $video_link?>" class="thumbnail">
                          <img src="<?if($value['video_cover']!=null) echo '../admin/'.$value['video_cover']; else echo '../admin/images/video_cover/default.png'?>" alt="">
                          <h5><?php echo $value['video_title']?></h5>
                        </a>
                      </div>
                      <?php
                    }
                  }
                }
              }else{
                if($init==0){
                  ?>
                  <?php
                  foreach($array as $value) {?>
                    <div class="col-xs-6 col-md-3">
                      <a href="detail.php?ciid=<?php echo $value['course_information_id']?>" class="thumbnail">
                        <img src="<?if($value['course_information_cover']!=null) echo '../admin/'.$value['course_information_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                        <h5><?php echo $value['course_information_title']?></h5>
                      </a>
                    </div>
                  <?php }?>
                  <?php
                }else{

                  if($page_num!=null){
                    foreach($page_array[$page_num] as $value){
                      ?>
                      <div class="col-xs-6 col-md-3">
                        <a href="detail.php?ciid=<?php echo $value['course_information_id']?>" class="thumbnail">
                          <img src="<?if($value['course_information_cover']!=null) echo '../admin/'.$value['course_information_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                          <h5><?php echo $value['course_information_title']?></h5>
                        </a>
                      </div>
                      <?php
                    }
                  }else{
                    foreach($page_array[1] as $value){
                      ?>
                      <div class="col-xs-6 col-md-3">
                        <a href="detail.php?ciid=<?php echo $value['course_information_id']?>" class="thumbnail">
                          <img src="<?php if($value['course_information_cover']!=null) echo '../admin/'.$value['course_information_cover']; else echo '../admin/images/course_information_cover/default.png'?>" alt="">
                          <h5><?php echo $value['course_information_title']?></h5>
                        </a>
                      </div>
                      <?php
                    }
                  }
                }
              }
              ?>
            </div>
            <nav class="text-center nav_page">
              <ul class="pagination">
                <li>
                  <?php
                  if($cid!=null){
                    if($page==0){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }else if($page_num-1==0||$page_num==null){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=1" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }else{
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=<?php echo $page_num-1?>" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }
                  }else{
                    if($page==0){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }else if($page_num-1==0||$page_num==null){
                      ?>
                      <a href="course.php?cit=<?php echo $cit?>&page=1" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }else{
                      ?>
                      <a href="course.php?cit=<?php echo $cit?>&page=<?php echo $page_num-1?>" aria-label="Previous" >
                        <span aria-hidden="true">上一页</span>
                      </a>
                      <?php
                    }
                  }
                  ?>

                </li>
                <li>
                  <?php
                  if($cid!=null){
                    if($page==0){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else if($page_num==null){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=2" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else if($page_num+1>$page){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=<?php echo $page_num?>" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else{
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=<?php echo $page_num+1?>" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }
                  }else{
                    if($page==0){
                      ?>
                      <a href="course.php?cid=<?php echo $cid?>&cit=<?php echo $cit?>&page=2" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else if($page_num==null){
                      ?>
                      <a href="course.php?cit=<?php echo $cit?>&page=2" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else if($page_num+1>$page){
                      ?>
                      <a href="course.php?cit=<?php echo $cit?>&page=<?php echo $page_num?>" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }else{
                      ?>
                      <a href="course.php?cit=<?php echo $cit?>&page=<?php echo $page_num+1?>" aria-label="Next" >
                        <span aria-hidden="true">下一页</span>
                      </a>
                      <?php
                    }
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