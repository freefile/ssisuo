<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"F:\ssisuo\ssisuo\webroot\public/../application/index/view/header.html";i:1493522564;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php foreach($user as $vo): ?> 
    <?php echo $vo->id; ?>:<?php echo $vo->name; endforeach; ?>
</body>
</html>