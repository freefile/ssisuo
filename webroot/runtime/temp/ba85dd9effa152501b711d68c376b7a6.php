<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\sys\index.html";i:1493888387;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493864698;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493862871;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
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

欢迎来到后台
<a href="/index/user/">用户管理</a>
 </body>
</html>