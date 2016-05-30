<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页</title>
<link rel="stylesheet" href="assets/amazeui.min.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
    <script>
        function info_main(src){  //修改元素的属性
            var index = document.getElementById("main");
            index.setAttribute("src",src);
        }
    </script>
</head>

<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    header("location:login/index.html");
}

?>
<div class="nav-top">
	<span>后台管理系统</span>
    <div class="nav-topright">
        <span>您好：<?php echo"$username";?></span><span><a href="login/login_out.php">注销</a></span>
    </div>
</div>
<div class="nav-down">
    <div class="leftmenu2">
        <ul>
            <li>
                <a class="j_a_list j_a_list3"></a>
                <div class="j_menu_list j_menu_list_first">
                    <span class="sp3"><i></i>信息发布</span>
                    <a class="j_lista_first" href="#" onclick="info_main('course_information_publish.php')">课程信息</a>
                    <a href="#" onclick="info_main('information_publish.php')">其他信息</a>
                </div>
            </li>
        	<li>
            	<a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list j_menu_list_first">
                	<span class="sp1"><i></i>信息列表</span>
                	<a class="j_lista_first" href="#" onclick="info_main('information_list.php?information_type=网站公告')">网站公告</a>
                    <a href="#" onclick="info_main('information_list.php?information_type=创业平台')">创业平台</a>
                    <a href="#" onclick="info_main('information_list.php?information_type=资源素材库')">资源素材库</a>
                    <a href="#" onclick="info_main('information_list.php?information_type=电商前沿')">电商前沿</a>
                </div>
            </li>
            <li>
            	<a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list">
                	<span class="sp1"><i></i>课程管理</span>
                    <a href="#" onclick="info_main('course_list.php')">课程列表</a>
                    <a href="#" onclick="info_main('course_information_list.php')">课程信息列表</a>
                </div>
            </li>
            <li>
                <a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list">
                    <span class="sp1"><i></i>人事管理</span>
                    <a href="#" onclick="info_main('user_list.php')">会员管理</a>
                    <a href="#" onclick="info_main('teacher_list.php')">教师管理</a>
                </div>
            </li>
            <li>
                <a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list">
                    <span class="sp1"><i></i>教学视频</span>
                    <a href="#" onclick="info_main('video_list.php')">视频列表</a>
                    <a href="#" onclick="info_main('video_publish.php')">视频发布</a>
                </div>
            </li>

            <li>
                <a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list">
                    <span class="sp1"><i></i>评测系统</span>
                    <a href="#" onclick="info_main('test_list.php')">试题列表</a>
                    <a href="#" onclick="info_main('test_publish.php')">试题发布</a>
                </div>
            </li>
            <li>
                <a class="j_a_list j_a_list1"></a>
                <div class="j_menu_list">
                    <span class="sp1"><i></i>商品管理</span>
                    <a href="#" onclick="info_main('goods_list.php')">商品列表</a>
                    <a href="#" onclick="info_main('goods_category_list.php')">分类管理</a>
                </div>
            </li>
            <li>
            	<a class="j_a_list j_a_list2"></a>
                <div class="j_menu_list">
                	<span class="sp2"><i></i>管理员</span>
                	<a href="#" onclick="info_main('admin_list.php')">管理员列表</a>
                    <a href="#" onclick="info_main('admin_add.html')">添加管理员</a>
                </div>
            </li>

            <li>
                <a class="j_a_list j_a_list2"></a>
                <div class="j_menu_list j_menu_list_first">
                    <span class="sp2"><i></i>个人信息</span>
                    <a href="#" onclick="info_main('password_change.html')">修改密码</a>
                </div>
            </li>


        </ul>
    </div>
    <div class="rightcon">
    	<div class="right_con">
            <iframe id='main' src='course_information_publish.php' frameborder='0' width='100%' height='600px'></iframe>
        </div>
    </div>
</div>

</body>
</html>
<script type="text/javascript">
	
</script>