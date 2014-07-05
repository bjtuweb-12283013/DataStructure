<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
<title><?php echo $site_name;?>注册 - Powered by Cyask</title>
<link href="<?php echo $web_path;?><?php echo $styledir;?>/default.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $web_path;?>js/base.js"></script>
<script type="text/javascript" src="<?php echo $web_path;?>include/functions.js"></script>
<script type="text/javascript" src="<?php echo $web_path;?>include/xmlhttp.js"></script>
<script type="text/javascript">
function parse_message(data)
{
var did=document.getElementById("usernametip");
if(data)
{
if(data=='no')
did.innerHTML='<font size="2" color="red">已经被注册的用户名，请换一个吧</font>';
else if(data=='yes')
did.innerHTML='<font size="2" color="green">这个名字可以注册，继续吧</font>';
else if(data=='error')
did.innerHTML='<font size="2" color="red">用户名中含有不允许的字符，请使用英文字母和数字</font>';
else
did.innerHTML='<font size="2" color="red"></font>';
}
else
{
did.innerHTML='<font size="2" color="red">正在检测......</font>';
}
}
function check_username(uname)
{
var did=document.getElementById("usernametip");
var url='process/usercheck.php?username='+uname;
if(uname=="")
{
did.innerHTML='<font size="2" color="red">用户名不能为空，请您填写一个用户名吧。</font>';
}
else if(uname.length<2)
{
did.innerHTML='<font size="2" color="red">您输入的用户名过短！</font>';
}
else
{
XMLHttp.getR(url,parse_message,'text');
}
}
function check_password(f)
{
if(f.password.value == '' || f.password.value == null)
{
document.getElementById("passwordtip").innerHTML="<font size=\"2\" color=\"red\">密码不能为空，请填写一个密码吧。</font>";
//f.password.focus();
}
else
{
document.getElementById("passwordtip").innerHTML="";
}
}
function check_confirmpw(f)
{
if(f.password.value != f.confirmpw.value)
{
document.getElementById("confirmpwtip").innerHTML="<font size=\"2\" color=\"red\">两次输入的密码不相同，请您重新设置吧！</font>";
//f.confirmpw.focus();
}
else
{
document.getElementById("confirmpwtip").innerHTML="";
}
}
function check_registform(f)
{
var username=str_trim(f.username.value);
f.username.value=username;
if(f.username.value == '' || f.username.value == null)
{
document.getElementById("usernametip").innerHTML='<font size="2" color="red">用户名不能为空，请您填写一个用户名吧。</font>';
f.username.focus();
return false;
}
if(f.password.value == '' || f.password.value == null)
{
document.getElementById("passwordtip").innerHTML="<font size=\"2\" color=\"red\">密码不能为空，请填写一个密码吧。</font>";
f.password.focus();
return false;
   	}
if(f.password.value.length<3)
{
document.getElementById("passwordtip").innerHTML="<font size=\"2\" color=\"red\">密码过短，为了安全，请设置6位以上密码。</font>";
f.password.focus();
return false;
}
if(f.password.value != f.confirmpw.value)
{
document.getElementById("confirmpwtip").innerHTML="<font size=\"2\" color=\"red\">两次输入的密码不相同，请您重新设置吧！</font>";
f.password.value = '';
f.confirmpw.value = '';
f.password.focus();
return false;
}
if(f.email.value=="" || f.email.value.indexOf("@")==-1 || f.email.value.indexOf(".")==-1)
{
document.getElementById("emailtip").innerHTML="<font color=\"red\">抱歉，您的邮箱地址错误。</font>";
return false;
} 
}
</script>
</head>

<body>
<div id="main" style="height:100%">
<div align="left">
<table cellspacing="3" cellpadding="3" width="100%" border="0">
<tr><td valign="top" width="160">&nbsp;&nbsp;<a href="<?php echo $web_path;?>"><img src="<?php echo $styledir;?>/1000ask.gif" border="0" /></a></td>
<td class="f14" nowrap="nowrap">&nbsp;&nbsp;<a href="<?php echo $web_path;?>"><b>返回首页</b></a></td></tr>
</table>
</div>
<div id="c90">
<div class="t3 bcb"><div class="t3t bgb">注册</div></div>
<div class="b3 bcb mb12">
<form name="registform" action="<?php echo $web_path;?>register.php" method="post" onsubmit="return check_registform(this);">
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<tr valign="middle"><td class="f14" height="50" align="center" colspan="3">您可以快速注册自己的用户名，如果您已经注册，请点此 <a href="<?php echo $web_path;?>login.php?url=<?php echo $url;?>">登录</a>。</td></tr>
<tr valign="middle" bgcolor="#efefef">
<td class="f14" width="35%" height="50" align="right" nowrap="nowrap">用户名 ：</td>
<td width="20%"><input name="username" size="20" maxlength="18" onBlur="check_username(this.value);" /></td>
<td width="45%"><span id="usernametip">用户名可以使用英文字母，也可以使用中文名字</span></td>
</tr>
<tr valign="middle">
<td class="f14" width="35%" align="right" height="45" nowrap="nowrap">输入登录密码 ：</td>
<td width="20%"><input type="password" name="password" size="20" maxlength="16" onBlur="check_password(registform);"/></td>
<td width="45%"><span id="passwordtip">密码长度为6～16位，区分字母大小写。登录密码可以由字母、数字、特殊字符组成。</span></td>
</tr>
<tr valign="middle" bgcolor="#efefef">
<td class="f14" width="35%" align="right" height="45" nowrap="nowrap">登录密码确认 ：</td>
<td width="20%"><input type="password" name="confirmpw" size="20" maxlength="16" onBlur="check_confirmpw(registform);" /></td>
<td width="45%"><span id="confirmpwtip">同密码设置一样。</span>
</td>
</tr>
<tr valign="middle">
<td class="f14" width="35%" align="right" height="45" nowrap="nowrap">电子邮箱 ：</td>
<td width="20%"><input type="text" name="email" size="20" maxlength="40" /></td>
<td width="45%"><span id="emailtip"></span>
</td>
</tr>
<tr valign="middle">
<td width="35%">&nbsp;</td>
<td width="65%" height="50" colspan="2" align="left">
<input type="submit" name="registsubmit" value="好了，提交" class="bnsrh" />
<input type="hidden" name="command" value="registed" />
<input type="hidden" name="formhash" value="<?php echo form_hash();?>" />
<input type="hidden" name="url" value="<?php echo $url;?>" />
</td></tr>
</table>
</form>
</div>
<br />
<?php include template('footer'); ?>
