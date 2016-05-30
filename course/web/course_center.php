<?php include 'header.php';?>
<?php
include_once 'functions.php';
$array_course=CourseCenter::getCourse();
$array_teacher=CourseCenter::getTeacher();
$init = 0;
$page = 0;
if(sizeof($array_teacher)>6) {
  $page = ceil(sizeof($array_teacher) / 6);
  for ($i = 1; $i <= $page; $i++) {
    for ($j = $init; $j < sizeof($array_teacher); $j++) {
      $init++;
      $page_array[$i][] = $array_teacher[$j];
      if($init%6==0) break;
    }
  }
}
?>
    <div class="main2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="mai">
              <div class="mai-title"><span class="text"><span class="s1"></span>课程中心<span class="s2"></span></span></div>
              <!-- <a href="#"><button class="btn_more">more</button></a> -->
              <ul class="books">
                <?php foreach($array_course as $value) {?>
                <li>
                  <a href="course.php?cid=<?php echo $value['course_id']?>">
                    <img src="images/book1.jpg">
                    <h4><?php echo $value['course_name']?></h4>
                  </a>
                </li>
                <?php }?>
              </ul>
            </div>
            
            <div id="pro" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" role="listbox" >
               <?php
                  if($init==0){
                    ?>
                    <div class="item  active" >
                      <div class="carousel-caption">
                        <div class="row  ttt">
                            <?php foreach($array_teacher as $value) { ?>
                              <div class="col-sm-2">
                                <a href="detail.php?tid=<?php echo $value['teacher_id']?>" class="thumbnail">
                                  <img src="<?php if($value['teacher_picture']==null)echo '../admin/images/teacher_images/default.png'; else echo $value['teacher_picture'] ?>" alt="">
                                  <h4><span><?php echo $value['teacher_name']?></span><?php echo $value['teacher_positional']?></h4>
                                  <p><?php echo $value['teacher_department']?></p>
                                  <p><?php echo $value['teacher_job']?></p>
                                </a>
                              </div>
                            <?php }?>
                        </div>
                      </div>
                    </div>
                    <?php
                  }else{
                    ?>
                    <div class="item  active" >
                      <div class="carousel-caption">
                        <div class="row  ttt">
                          <?php foreach($page_array[1] as $value) { ?>
                            <div class="col-sm-2">
                              <a href="detail.php?tid=<?php echo $value['teacher_id']?>" class="thumbnail">
                                <img src="<?php if($value['teacher_picture']==null)echo '../admin/images/teacher_images/default.png'; else echo $value['teacher_picture'] ?>" alt="">
                                <h3><span><?php echo $value['teacher_name']?></span><?php echo $value['teacher_positional']?></h3>
                                <p><?php echo $value['teacher_department']?></p>
                                <p><?php echo $value['teacher_job']?></p>
                              </a>
                            </div>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                    <?php
                    for($i=2;$i<=$page;$i++){
                      ?>
                      <div class="item" >
                        <div class="carousel-caption">
                          <div class="row  ttt">
                            <?php foreach($page_array[$i] as $value) { ?>
                              <div class="col-sm-2">
                                <a href="detail.php?tid=<?php echo $value['teacher_id']?>" class="thumbnail">
                                  <img src="<?php if($value['teacher_picture']==null)echo '../admin/images/teacher_images/default.png'; else echo $value['teacher_picture'] ?>" alt="">
                                  <h3><span><?php echo $value['teacher_name']?></span><?php echo $value['teacher_positional']?></h3>
                                  <p><?php echo $value['teacher_department']?></p>
                                  <p><?php echo $value['teacher_job']?></p>
                                </a>
                              </div>
                            <?php }?>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                  }
               ?>
              </div>
              <a class="left carousel-control" href="#pro" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#pro" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php';?>
