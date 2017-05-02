<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"F:\ssisuo\ssisuo\webroot\public/../application/index\view\sys\header.html";i:1493721498;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
用户名：<?php echo $user_name; ?><br />
<?php foreach($user as $vo): ?> 
    <?php echo $vo->id; ?>:<?php echo $vo->name; endforeach; ?>
</body>
</html>