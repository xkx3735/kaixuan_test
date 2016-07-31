<?php

$userid = $_COOKIE['userid'];
if(empty($userid)){
    header('location:index.php');
}
setcookie('userid','',time()-1,'/','.hehe.com');
setcookie('username','',time()-1,'/','.hehe.com');
setcookie('token','',time()-1,'/','.hehe.com');

header('location:index.php');