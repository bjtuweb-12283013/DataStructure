<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
<title><?php echo $site_name;?>登录 - Powered by Cyask</title>
<link href="<?php echo $styledir;?>/default.css" type=text/css rel=stylesheet />
<script type="text/javascript" src="include/functions.js"></script>
<script type="text/javascript">
function check_getpwform(f)
{
if(f.email.value=="")
{
f.email.focus();
alert("Email 地址不能为空");
return false;
}
}
</script>
</head>

<body>
<div id="main" style="height:100%">
<div align="left">
<table cellspacing="3" cellpadding="3" width="100%" border="0">
<tr><td valign="top" width="160">&nbsp;&nbsp;<a href="./"><img src="<?php echo $styledir;?>/1000ask.gif" border="0" /></a></td>
<td class="f14" nowrap="nowrap">&nbsp;&nbsp;<a href="./"><b>返回首页</b></a></td></tr>
</table>
</div>
<div id="c90">
<div class="t3 bcb"><div class="t3t bgb">重设密码</div></div>
<div class="b3 bcb mb12">
<br />
<form name="loginform" action="register.php" method="post" onsubmit="return check_getpwform(this);">
<table cellspacing="0" cellpadding="0" width="100%" valign="top" border="0">
<tr><td class="f14" width="100%" height="50" colspan="2" valign="top" align="center">重新设置密码：填写您注册时所用的邮箱地址</td></tr>
<tr><td class="f14" width="40%" height="35" align="right" valign="top" nowrap="nowrap">电子邮箱 :&nbsp;&nbsp;&nbsp;</td>
<td width="60%" height="35" valign="top"><input type="text" name="email" size="30" maxlength="50" /></td></tr>
<tr>
<td class="f14" height="35" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
<td height="35" valign="top">
<input type="submit" name="getpwsubmit" value="重设密码" class="bnsrh" />
<input type="hidden" name="command" value="getpw" />
<input type="hidden" name="formhash" value="<?php echo form_hash();?>" />
<input type="hidden" name="url" value="<?php echo $url;?>" />
</td></tr>
</table>
</form>
<br />
</div>
</div>
<br />
<?php include template('footer'); ?>
