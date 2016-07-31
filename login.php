<?php
require('./lib.php');
include('./header.php');
$username = P('username');
$passwd = P('password');

//去检查用户名和密码是不是对的

if(empty($username) || empty($passwd)){
    error('请输入用户名和密码');
}

$r = connRedis();
$get_userid = $r->get('user:username:'.$username.':userid');
if(empty($get_userid)){
    error('该用户不存在');
}
$passwd2 = $r->get('user:userid:'.$get_userid.':passwd');
if(md5($passwd) != $passwd2){
    error('您输入的密码不正确');
}

//此处应该是登录成功,设置cookie并且确保安全性
setcookie('username',$username,time()+3600,'/','.hehe.com');
setcookie('userid',$get_userid,time()+3600,'/','.hehe.com');

//登录的时候同时往redis中插入token
$randstr = getRandStr();
setcookie('token',$randstr,time()+3600,'/','.hehe.com');
$r->set('user:userid:'.$get_userid.':token',$randstr);

header('Location:home.php');