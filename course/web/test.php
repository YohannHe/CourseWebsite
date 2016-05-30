<link href="css/list.css" rel="stylesheet">
<style>
    ul {
        list-style: none;
    }
</style>
</head>
<body>
<?php
require_once 'header.php';
include_once 'functions.php'
?>
<?php
@$tt = $_GET['tt'];
@$cid = $_GET['cid'];
if ($tt == null) $tt = '自测系统';
$array_Course = Main::getCourse();
$array = Information::getTest($tt, $cid,-1);
//分页处理
$page = ceil(sizeof($array) / 12);
@$page_num = $_GET['page'];
if ($page > 1) {
   if($page_num!=null){
       $num = ($page_num-1)*12;
       $array = Information::getTest($tt, $cid, $num);
   }else{
       $array=null;
       $array = Information::getTest($tt, $cid, 0);
   }
}
?>

<div class="ec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><?php echo $tt ?></li>
                    <li class="active"><?php echo Main::getCourseName($cid)['course_name'] ?></li>
                </ol>
            </div>
        </div>
        <div class="row" style="height: 530px">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><?php echo $tt ?></h3></div>
                    <div class="list-group">
                        <?php
                        if ($cid == null) {
                            ?>
                            <a href="test.php?tt=<?php echo $tt ?>" class="list-group-item active">全部</a>
                            <?php
                        } else {
                            ?>
                            <a href="test.php?tt=<?php echo $tt ?>" class="list-group-item">全部</a>
                            <?php
                        }
                        foreach ($array_Course as $value) {
                            if ($value['course_id'] == $cid) {
                                ?>
                                <a href="test.php?cid=<?php echo $value['course_id'] ?>&tt=<?php echo $tt ?>"
                                   class="list-group-item active"><?php echo Main::getCourseName($value['course_id'])['course_name'] ?></a>
                                <?php
                            } else {
                                $course_id = $value['course_id'];
                                ?>
                                <a href="test.php?cid=<?php echo $course_id ?>&tt=<?php echo $tt ?>"
                                   class="list-group-item"><?php echo Main::getCourseName($course_id)['course_name'] ?></a>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div id="conn" class="con media-list list-group-item">
                    <ul>
                        <?php
                            foreach ($array as $value) { ?>
                                <li><span><?php echo $value['test_time'] ?></span><a
                                        href="<?php echo $value['test_link'] ?>"
                                        target="_blank"><?php echo $value['test_title'] ?></a></li>
                            <?php } ?>
                    </ul>
                </div>
                <nav class="text-center nav_page" style="margin-top: 120px">
                    <ul class="pagination">
                        <li>
                            <?php
                                if($cid==null){
                                    ?>
                                    <a href="test.php?tt=<?php echo $tt ?>&page=<?php if($page_num-1>=1)echo $page_num-1;else echo 1;?>" aria-label="Previous">
                                        <span aria-hidden="true">上一页</span>
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <a href="test.php?cid=<?php echo $cid ?>&tt=<?php echo $tt ?>&page=<?php if($page_num-1>=1)echo $page_num-1;else echo 1;?>" aria-label="Next">
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
                                <a href="test.php?tt=<?php echo $tt ?>&page=<?php if($page_num==null)echo 2; else if($page_num+1<=$page)echo $page_num+1;else echo $page;?>" aria-label="Previous">
                                    <span aria-hidden="true">下一页</span>
                                </a>
                                <?php
                            }else{
                                ?>
                                <a href="test.php?cid=<?php echo $cid ?>&tt=<?php echo $tt ?>&page=<?php if($page_num==null)echo 2; else if($page_num+1<=$page)echo $page_num+1;else echo $page;?>" aria-label="Next">
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
<?php
require_once 'footer.php';
?>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>