<?php include('./lib.php'); ?>
<?php include('./header.php');
    $is_login = is_login();
if(!$is_login){
    header('location:index.php');
}
$r =connRedis();
//查看有几个粉丝

$followings  = $r->sCard('following:userid:'.$_COOKIE['userid']);
$fans = $r->sCard('fans:userid:'.$_COOKIE['userid']);

//把我的recieve 中的postid取出来，展示

$r->ltrim('recieve:userid:'.$_COOKIE['userid'].':postid',0,50);
$posts = $r->lrange('recieve:userid:'.$_COOKIE['userid'].':postid',0,50);

?>
<div id="postform">
<form method="POST" action="post.php">
<?php echo $_COOKIE['username']; ?>, 有啥感想?
<br>
<table>
<tr><td><textarea cols="70" rows="3" name="status"></textarea></td></tr>
<tr><td align="right"><input type="submit" value="Update"></td></tr>
</table>
</form>
<div id="homeinfobox">
    <?php echo $fans; ?> 粉丝<br>
    <?php echo $followings; ?> 关注<br>
</div>
</div>
<?php foreach ($posts as $post) { $res = $r->hMGet('post:postid:'.$post.':status',array('status','time','username'));   ?>
<div class="post">
        <a class="username" href="profile.php?u=<?php echo $res['username']; ?>"><?php echo $res['username']; ?></a> <?php echo $res['status']; ?><br>
<i><?php echo $res['time'] ?> 分钟前 通过 web发布</i>
</div>
<?php  }?>
<?php include('./footer.php'); ?>
