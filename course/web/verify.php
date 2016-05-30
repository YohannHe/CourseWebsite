<?php
//绘制验证码
header('content-type:image/png');
session_start();
$height = 40;
$width = 100;
$image = imagecreatetruecolor($width,$height);
$color = imagecolorallocate($image,255,255,255);
imagefilledrectangle($image,1,1,$width-2,$height-2,$color);
$verifycode = "";
for($i=0;$i<4;$i++){
    $x=($i*100/4)+mt_rand(5,10);
    $y=mt_rand(15,35);
    $fontsiz=mt_rand(20,25);
    $fontcolor=imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
    $angle=mt_rand(-15,15);
    $fontfile = 'fonts/'.rand_font();
    $text = rand_char();
    $verifycode.=$text;
    imagettftext($image,$fontsiz,$angle,$x,$y,$fontcolor,$fontfile,$text);
}
$_SESSION['vcode']= $verifycode;
//干扰元素点
for($i=0;$i<=100;$i++){
    $pixelcolor=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imagesetpixel($image,mt_rand(0,100),mt_rand(0,40),$pixelcolor);
}
//干扰元素线条
for($i=0;$i<=7;$i++){
    $linelcolor=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imageline($image,mt_rand(0,100),mt_rand(0,40),mt_rand(0,100),mt_rand(0,40),$linelcolor);
}

imagepng($image);
imagedestroy($image);
//产生随机字符
function rand_char(){
    $str = join("",array_merge(range(0,9),range('a','z'),range('A','Z')));
    return $str[mt_rand(0,61)];
}
//随机字体
function rand_font(){
    $fonts= array('FZSTK.TTF','SIMLI.TTF','STHUPO.TTF','STXIHEI.TTF');
    return $fonts[mt_rand(0,3)];
}



