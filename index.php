<?php include('./lib.php'); ?>
<?php include('./header.php'); ?>
<?php
  //判断用户是否登录，如果登录了就跳转到home
  $is_login = is_login();
  if($is_login){
    header('location:home.php');
  }
?>
<div id="welcomebox">
<div id="registerbox">
<h2>注册!</h2>
<b>想试试Retwis? 请注册账号!</b>
<form method="POST" action="register.php">
<table>
<tr>
  <td>用户名</td><td><input type="text" name="username"></td>
</tr>
<tr>
  <td>密码</td><td><input type="password" name="password"></td>
</tr>
<tr>
  <td>密码(again)</td><td><input type="password" name="password2"></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" name="doit" value="注册"></td></tr>
</table>
</form>
<h2>已经注册了? 请直接登陆</h2>
<form method="POST" action="login.php">
<table><tr>
  <td>用户名</td><td><input type="text" name="username"></td>
  </tr><tr>
  <td>密码:</td><td><input type="password" name="password"></td>
  </tr><tr>
  <td colspan="2" align="right"><input type="submit" name="doit" value="Login"></td>
</tr></table>
</form>
</div>
<?php include('./footer.php'); ?>