<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:71:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\sys\test.html";i:1493862405;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493803787;s:72:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\user\info.html";i:1493861193;s:73:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\user\login.html";i:1493862920;s:79:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\form_login.html";i:1493862784;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>fdsfsd</title>
</head>
<body>
<div><?php if(($online->user_id > 0)): ?><a href="/index/user/logout" title="注销"><?php echo $user->name; ?></a>已登陆
<?php else: ?> 未登陆
<?php endif; ?></div>

<?php if(($online->user_id == 0)): ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>fdsfsd</title>
</head>
<body>
<div><?php if(($online->user_id > 0)): ?><a href="/index/user/logout" title="注销"><?php echo $user->name; ?></a>已登陆
<?php else: ?> 未登陆
<?php endif; ?></div>

<form action="/index/user/login" method="post" >
 用户名：<input type="text" name="name" /><br />
 密码<input type="text" name="psd" /><br />
 <input type="submit" value="提交" />
 </form>
 </body>
</html>
<?php endif; ?>
 </body>
</html>