<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:75:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\user\adduser.html";i:1493884805;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\header.html";i:1493864698;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\text_userinfo.html";i:1493862871;s:82:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\model\form_add_user.html";i:1493882497;s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\footer.html";i:1493783973;}*/ ?>
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
<form action="/index/user/adduser" method="post" >
 用户名：<input type="text" name="name" value="<?php echo $input['name']; ?>" /><br />
 密码<input type="text" name="psd" value="<?php echo $input['psd']; ?>" /><br />
 权限<input type="text" name="limit_level" value="<?php echo $input['limit_level']; ?>" /><br />
 群组<input type="text" name="group_name"  value="<?php echo $input['group_name']; ?>"/><br />
  <input type="submit" value="提交" />
 </form>
 </body>
</html>