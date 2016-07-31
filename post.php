<?php
require('./lib.php');
include('./header.php');

$is_login = is_login();
if(!$is_login){
    header('location:index.php');
}

$status = P('status'); //获取到的内容
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

//设计post表
$r = connRedis();
$postid = $r ->incr('global:postid');
$r->lPush('user:userid:'.$userid.':postid',$postid);  //user表中增加postid，此处使用hash结构，因为post中存在很多相关信息

//  发送微博模型， 当我发送微博   像我的粉丝推送微博，当然也包括我自己
$r->hMset('post:postid:'.$postid.':status',array('status'=>$status,'time'=>time(),'username'=>$username));  //post表中增加post内容

//推模型,维护一个单独的set,获取我的粉丝们
$members = $r->sMembers('fans:userid:'.$userid);

$members[] =$userid;//也包含我自己

foreach ($members as $userid) {
    $r->lpush('recieve:userid:'.$userid.':postid',$postid);
}

header('location:home.php');
