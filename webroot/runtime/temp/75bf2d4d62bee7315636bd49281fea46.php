<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:75:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\user\deluser.html";i:1493884081;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493864698;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493862871;s:83:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\list_del_users.html";i:1493884669;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
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

<?php echo $check_msg; ?>
<form action="/index/user/delUser" method="post">
<ul>
<?php foreach($users as $obj): ?>
<li><input type="checkbox" name="del_user_ids[]" value="<?php echo $obj->id; ?>" /><?php echo $obj->name; ?></li>
<?php endforeach; ?>
</ul>
<input type="submit" value="删除" />
</form>
 </body>
</html>