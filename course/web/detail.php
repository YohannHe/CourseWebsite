<?php include 'header.php';?>
<?php
include_once 'functions.php';
@$information_id=$_GET['information_id'];
@$ciid=$_GET['ciid'];
@$tid=$_GET['tid'];
if($ciid!=null){
  $item = Main::getInfoDetail($ciid);
  $body = $item['course_information_body'];
  $title=$item['course_information_title'];
}else if($tid!=null){
  $item=CourseCenter::getTeacherDetail($tid);
  $body = $item['teacher_body'];
}else if($information_id!=null){
  $item = Information::getInfDetail($information_id);
  $body=$item['information_body'];
  $title=$item['information_title'];
}
?>
    <div class="ec">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
<!--              <li>电商前言</li>-->
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="page-header">
              <?php
                if($tid!=null){
                  ?>
                  <h1>教师简介<small>宁波电子商务学院</small></h1>
                  <?php
                }else{
                  ?>
                  <h1><?php echo $title?><small>宁波电子商务学院</small></h1>
                  <?php
                }
              ?>

            </div>
            <div class="page-content">
              <?php

                  echo $body;

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php';?>