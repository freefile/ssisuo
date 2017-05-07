<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:74:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\index\index.html";i:1493973936;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1494133939;s:72:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\nav.html";i:1494127139;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493956055;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<base href="http://www.s.com/" />
<base target="_selef" />
<meta charset="utf-8">
<meta name="viewport"
	content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
<title>首页</title>
<style type="text/css">
html, body, * {font-family: "Microsoft YaHei" ! important; } 
code {font-family: "Consolas" ! important; } 
</style>
</head>
<body>
	<header><nav>
	<a href="index/users/index">用户</a>| <a href="index/members/index">成员</a>|
	<a href="index/customers/index">顾客</a>
</nav> <?php if(($online->user_id > 0)): ?><a href="/index/users/logout" title="注销"><?php echo $user->name; ?></a>已登陆
<?php else: ?><a href="/index/users/login">未登陆</a>
<?php endif; ?> </header><br />
欢迎来到首页，这个是最巴适的一个页面了
<?php echo $isMobile; ?>
 </body>
</html>