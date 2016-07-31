<?php include('./lib.php'); ?>
<?php include('./header.php');
$is_login = is_login();
if(!$is_login){
    header('location:index.php');
}
$r =connRedis();
$reglist = $r->lRange('reglist',0,20);//取出20个已经注册的
print_r($reglist);

$res = $r->sort('reglist',array('sort'=>desc,'get'=>'user:userid:*:username'));
?>

<h2>热点</h2>
<i>最新注册用户(redis中的sort用法)</i><br>
<div>
<?php foreach($res as $user){ ?>
    <a class="username" href="profile.php?u=<?php echo $user;?>"><?php echo $user;?></a>
<?php } ?>
</div>

<br><i>最新的50条微博!</i><br>
<div class="post">
<a class="username" href="profile.php?u=test">test</a>
world<br>
<i>22 分钟前 通过 web发布</i>
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
