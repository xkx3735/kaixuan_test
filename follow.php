
<?php
require('./lib.php');
include('./header.php');
if(empty($_GET) || !isset($_GET['uid'])  || !isset($_GET['f'])){
    error('系统错误');
}
$userid = G('uid');
$r = connRedis();
$username = $r->get('user:userid:'.$userid.':username');

//用户关注，使用lpush 即可

if(G('f') == 1){
    $r->sAdd('following:userid:'.$_COOKIE['userid'], $userid);//前面是我的user_id 这是我关注的
    $r->sAdd('fans:userid:'.$userid,$_COOKIE['userid'] ); //这是关注我的
}else{
    $r->sRem('following:userid:'.$_COOKIE['userid'], $userid);//前面是我的user_id 这是我关注的
    $r->sRem('fans:userid:'.$userid,$_COOKIE['userid']); //这是关注我的
}


header('location:profile.php?u='.$username);