<?php
require('./lib.php');
include('./header.php');
$username = P('username');
$passwd = P('password');
$passwd2 = P('password2');

if($passwd!= $passwd2){
    error('两次输入密码不一致');
}
$r = connRedis();
$exist_userid = $r->get('user:username:'.$username.':userid');
if(!empty($exist_userid)){
    error('数据库中已经存在这个用户');
}

$userid = $r->incr('global:userid');
//去数据库查询是否已经存在这个username


$r->set('user:userid:'.$userid.':username',$username);
$r->set('user:userid:'.$userid.':passwd',md5($passwd));
$r->set('user:username:'.$username.':userid',$userid);  //需要根据用户名来查id

//每次注册一个用户就要放入我们的注册列表中
$r->lPush('reglist',$userid);

error('恭喜注册成功');
include('./footer.php');