<?php
require('./lib.php');
include('./header.php');
if(empty($_GET) || empty($_GET['u'])){
    error('系统错误');
}
$username = G('u');
$r = connRedis();
$userid = $r->get('user:username:'.$username.':userid');
if(empty($userid)){
    error('没有这个用户');
}
//查看我是否关注了这个用户,查看我的关注中是否有
$followers = $r->sMembers('following:userid:'.$_COOKIE['userid']); //我关注的人


$if_guanzhu = in_array($userid,$followers)?true:false; //如果为true代表已经关注，为false代表未关注

?>
<h2 class="username">test</h2>
<?php
if($if_guanzhu){  ?>
    <a href="follow.php?uid=<?php echo $userid; ?>&f=0" class="button">取消关注</a>
<?php }else{ ?>
    <a href="follow.php?uid=<?php echo $userid; ?>&f=1" class="button">关注</a>
<?php } ?>



<div class="post">
<a class="username" href="profile.php?u=<?php echo $username;?>"><?php echo $username;?></a>
world<br>
<i>11 分钟前 通过 web发布</i>
</div>

<div class="post">
<a class="username" href="profile.php?u=test">test</a>
hello<br>
<i>22 分钟前 通过 web发布</i>
</div>

<div id="footer">redis版本的仿微博项目 <a href="http://redis.io">Redis key-value database</a></div>
</div>
</body>
</html>
