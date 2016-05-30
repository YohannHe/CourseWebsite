<?php
/**
 * Created by PhpStorm.
 * User: Yohann
 * Date: 2016/2/17
 * Time: 16:35
 */
if (!session_id()) session_start();
$_SESSION['user'] = null;
header("location:index.php");