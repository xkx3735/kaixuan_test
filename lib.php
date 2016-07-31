<?php
error_reporting(E_ALL);
function P($str){
    return $_POST[$str];
}

function G($str){
    return $_GET[$str];
}

function connRedis(){
    $r = new Redis();
    $r->connect('127.0.0.1');
    return $r;
}
function error($str){
    echo $str;
    include('./footer.php');
    exit;
}

function getRandStr(){
    $str = 'abcdefghijklmnOPABCDEFGHIG';
    $return = substr(md5(str_shuffle($str)),0,10);
    return $return;
}
function is_login(){
    if(!isset($_COOKIE['username']) || !isset($_COOKIE['userid']) || !isset($_COOKIE['token']) ){
        return false;
    }

    $r = connRedis();
    $token = $r->get('user:userid:'.$_COOKIE['userid'].':token');
    if($token != $_COOKIE['token']){
        error('非法进入，请通过正规渠道进入本系统');
    }
    return true;
}