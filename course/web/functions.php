<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/17
 * Time: 13:24
 */
class Index{
    function login($username,$passwd){
        $pdo=DBConnection::getInstance();
        $sql = "select user_password from user WHERE user_account='$username'";
        $result = $pdo->query($sql);
        $item = $result->fetch();
        if($item['user_password']==$passwd){
            return true;
        }else{
            return false;
        }
        $result==null;
        $pdo==null;
    }
    function reg($username,$password,$name,$age,$sex){
        $check = new Check();
        if($check->userName($username)){
            $pdo=DBConnection::getInstance();
            $sql = "insert into user(user_account,user_password,user_name,user_sex,user_age)VALUES ('$username','$password','$name','$sex','$age')";
            $result = $pdo->exec($sql);
            if($result>0){
                return "注册成功！";
            }else{
                return "注册失败！";
            }
        }else{
            return "账号已存在！";
        }

    }
     function gonggao(){
         $pdo=DBConnection::getInstance();
         $sql = "select information_id,information_title from information where information_type='网站公告'";
         $result = $pdo->query($sql);
         $item = $result->fetchAll();
         return $item;
         $result==null;
         $pdo==null;
    }
}
class Check{
    function userName($username){
        $pdo=DBConnection::getInstance();
        $sql = "select * from user WHERE user_account='$username'";
        $result = $pdo->query($sql);
        if($row=$result->fetch()){
            return false;
        }else{
            return true;
        }
    }
}
class DBConnection{
    static function getInstance() {
        require_once "config.php";
            try{
                $pdo = new PDO(DSN,MYSQL_USER,MYSQL_PW);
                $pdo->exec("SET names utf8");
            }catch (PDOException $e){
                die("数据库连接失败!".$e->getMessage());
            }

        return $pdo ;
    }
}
class Grzx{
    static function grxx($username){

            $pdo=DBConnection::getInstance();
            $sql = "select user_account,user_name,user_sex,user_age,register_time from user WHERE user_account='$username'";
            $result = $pdo->query($sql);
            return  $result->fetch();

    }
    static function xgzl($username,$name,$age,$sex){
        $pdo=DBConnection::getInstance();
        $sql = "update user set user_name='$name',user_age='$age' ,user_sex='$sex' WHERE user_account='$username'";
        $result = $pdo->exec($sql);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }

    static function xgmm($username,$password){
        $pdo=DBConnection::getInstance();
        $sql = "update user set user_password='$password'WHERE user_account='$username'";
        $result = $pdo->exec($sql);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
}
class Main{
    //cid为课程id，cit为course_information_type
    static function get($cid,$cit,$num){
        $pdo=DBConnection::getInstance();
        if($num!=-1){
            if($cid!=null){
                $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_information_type='$cit' AND course_id='$cid'  LIMIT $num,12";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }else{
                $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_information_type='$cit'  LIMIT $num,12";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }

        }else{
            if($cid!=null){
                $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_information_type='$cit' AND course_id='$cid'";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }else{
                $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_information_type='$cit'";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }
        }


    }
    static function getInfoDetail($ciid){
        $pdo=DBConnection::getInstance();
        $sql = "select course_information_title, course_information_body from course_information WHERE course_information_id='$ciid'";
        $result = $pdo->query($sql);
        return $result->fetch();
    }
    static function getVideo($cid,$num){
        $pdo=DBConnection::getInstance();
        if($num!=-1){
            if($cid!=null){
                $sql = "select video_title,video_link,video_cover from video WHERE  course_id='$cid' LIMIT $num,12";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }else{
                $sql = "select video_title,video_link,video_cover from video  LIMIT $num,12";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }
        }else{
            if($cid!=null){
                $sql = "select video_title,video_link,video_cover from video WHERE  course_id='$cid'";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }else{
                $sql = "select video_title,video_link,video_cover from video";
                $result = $pdo->query($sql);
                return $result->fetchAll();
            }
        }



    }
    static function indexGet($information_type){
        $pdo=DBConnection::getInstance();
        $sql = "select information_id,information_title,information_time from information WHERE information_type='$information_type'";
        $result = $pdo->query($sql);
        return $result->fetchAll();

    }
    static function information_detail($information_id){
        $pdo=DBConnection::getInstance();
        $sql = "select information_body,information_title,information_time from information WHERE information_id='$information_id'";
        $result = $pdo->query($sql);
        return $result->fetch();
    }
    //获取所有课程和课程ID
    static function getCourse(){
        $pdo=DBConnection::getInstance();
        $sql = "select * from course";
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }
    static function getCourseName($cid){
        $pdo=DBConnection::getInstance();
        if($cid!=null){
            $sql = "select course_name from course WHERE course_id='$cid'";
            $result = $pdo->query($sql);
            return $result->fetch();
        }else{
            return null;
        }

    }
}
class CourseCenter
{
    //获取所有课程和课程ID
    static function getCourse()
    {
        $pdo = DBConnection::getInstance();
        $sql = "select * from course";
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }

    static function getTeacher()
    {
        $pdo = DBConnection::getInstance();
        $sql = "select teacher_id,teacher_name,teacher_positional,teacher_department,teacher_job,teacher_picture from teacher ";
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }

    static function getTeacherDetail($tid){
        $pdo = DBConnection::getInstance();
        $sql = "select teacher_body from teacher WHERE teacher_id='$tid'";
        $result = $pdo->query($sql);
        return $result->fetch();
    }
}
class  Information {
    static function getInf($it,$num){
        $pdo=DBConnection::getInstance();
        if($num!=-1){
            $sql = "select information_id,information_title,information_time from information where information_type='$it' LIMIT $num,12";
            $result = $pdo->query($sql);
            $item = $result->fetchAll();
        }else{
            $sql = "select information_id,information_title,information_time from information where information_type='$it'";
            $result = $pdo->query($sql);
            $item = $result->fetchAll();
        }
        return $item;
    }
    static function getInfDetail($iid){
        $pdo=DBConnection::getInstance();
        $sql = "select information_body,information_title,information_time from information where information_id='$iid'";
        $result = $pdo->query($sql);
        $item = $result->fetch();
        return $item;
    }
    static function getTest($tt,$cid,$num){
        $pdo=DBConnection::getInstance();
        if($num!=-1){
            if($cid!=null){
                $sql = "select test_title,test_link,test_time from test where course_id='$cid' and test_type='$tt' LIMIT $num,12 ";
            }else{
                $sql = "select test_title,test_link,test_time from test  where test_type='$tt' LIMIT $num,12";
            }
            $result = $pdo->query($sql);
            $item = $result->fetchAll();
        }else{
            if($cid!=null){
                $sql = "select test_title,test_link,test_time from test where course_id='$cid' and test_type='$tt'";
            }else{
                $sql = "select test_title,test_link,test_time from test where test_type='$tt'";
            }
            $result = $pdo->query($sql);
            $item = $result->fetchAll();
        }
        return $item;
    }

}
class Course{
    static function getCourseName($cid)
    {
        $pdo = DBConnection::getInstance();
        $sql = "select course_name from course WHERE course_id='$cid'";
        $result = $pdo->query($sql);
        return $result->fetch()['course_name'];
    }
    static function getVideo($cid){
        $pdo=DBConnection::getInstance();
            $sql = "select video_title,video_link,video_cover from video WHERE  course_id='$cid'";
            $result = $pdo->query($sql);
            return $result->fetchAll();
    }
    static function get($cid,$cit){
        $pdo=DBConnection::getInstance();
        if($cit!=null){
            $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_information_type='$cit' AND course_id='$cid'";
            $result = $pdo->query($sql);
            return $result->fetchAll();
        }else{
            $sql = "select course_information_id, course_information_title,course_information_cover from course_information WHERE course_id='$cid'";
            $result = $pdo->query($sql);
            return $result->fetchAll();
        }
    }
}