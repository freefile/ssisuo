<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\sys\index.html";i:1493959293;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493963054;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493956055;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>fdsfsd</title>
</head>
<body>
<div><?php if(($online->user_id > 0)): ?><a href="/index/users/logout" title="注销"><?php echo $user->name; ?></a>已登陆
<?php else: ?><a href="/index/users/login">未登陆</a>
<?php endif; ?></div>
<div>
<a href="/index/sys">后台管理</a><br />
><a href="/index/users">用户管理</a> | 
><a href="/index/members">成员管理</a> | 
><a href="/index/customers">顾客管理</a>
</div>
<br /><br />
欢迎来到后台
<a href="/index/users/">用户管理</a>
 </body>
</html>