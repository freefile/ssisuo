<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:73:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\user\index.html";i:1493883801;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493864698;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493862871;s:79:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\form_login.html";i:1493862784;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>fdsfsd</title>
</head>
<body>
<div><?php if(($online->user_id > 0)): ?><a href="/index/user/logout" title="注销"><?php echo $user->name; ?></a>已登陆
<?php else: ?><a href="/index/user/login">未登陆</a>
<?php endif; ?></div>

<?php if(($online->user_id == 0)): ?>
<form action="/index/user/login" method="post" >
 用户名：<input type="text" name="name" /><br />
 密码<input type="text" name="psd" /><br />
 <input type="submit" value="提交" />
 </form>
<?php else: ?>
<a href="/index/user/addUser/">添加用户</a>
<a href="/index/user/delUser/">删除用户</a>
<?php endif; ?>
 </body>
</html>