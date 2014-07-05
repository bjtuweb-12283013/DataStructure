<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="<?php echo $meta_keywords;?>" />
<link href="<?php echo $web_path;?><?php echo $styledir;?>/default.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $web_path;?>js/base.js"></script>
<script type="text/javascript" src="<?php echo $web_path;?>include/functions.js"></script>
<script type="text/javascript" src="<?php echo $web_path;?>include/xmlhttp.js"></script>
<script type="text/javascript">
function limit_words(varfield,obj_str,limit_len)
{
    var leftchars = get_left_chars(varfield,limit_len);
    if (leftchars >= 0)
    {   
    	return true;
    }
    else
    {
       ls_str = obj_str + "的长度请限定在" + limit_len + "个汉字以内！";
       window.alert(ls_str);
       return false;     
    } 
    return true;
}
function search_submit(f)
{
if(f.word.value.length<2)
{
alert("问题标题不详细，请重新输入");
return false;
}
}
function ask_submit()
{
var word=document.wordform.word.value;
location.href="<?php echo $web_path;?>ask.php?word="+word;
}
function parse_message(data)
{
var did=document.getElementById("newmessagetip");
if(data)
{
if(data >=1)
{
did.innerHTML='&nbsp;&nbsp;<a href="my.php?command=mymessage"><font size="2" color="red">有新消息</font></a>&nbsp;&nbsp;';

}
else
{
did.innerHTML='';
}
}
else
{
did.innerHTML='<font size="2" color="red">消息检测中...</font>';
}
}
</script>
</head>

<body>
<div id="main">
<div id="usrbar">
<nobr>
<script type="text/javascript">
var cyask_user='<?php echo $cyask_user;?>';
if(cyask_user)
{
document.write('<a href="../">返回首页</a>&nbsp;|欢迎回来&nbsp;<strong>'+cyask_user+'</strong>&nbsp;<span id="newmessagetip"></span>&nbsp;<a href="<?php echo $web_path;?>my.php">个人中心</a>&nbsp;|&nbsp;<a href="<?php echo $web_path;?>login.php?command=logout&url='+StrCode(location.href)+'">退出</a>');
XMLHttp.getR('<?php echo $web_path;?>process/msgcheck.php',parse_message,'text');
var adminid='<?php echo $cyask_adminid;?>';
if(adminid==1)
{
document.write('&nbsp;|&nbsp;<a href="<?php echo $web_path;?>admin.php">系统设置</a>');
}
}
else
{
document.write('<a href="../">返回首页</a>&nbsp;|&nbsp;<a href="<?php echo $web_path;?>login.php?url='+StrCode(location.href)+'">登录</a>&nbsp;|&nbsp;<a href="<?php echo $web_path;?>register.php?url='+StrCode(location.href)+'">注册</a>');
}
</script>
</nobr>
</div>
<div id="head">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" width="32"><a href="<?php echo $web_path;?>"><img src="<?php echo $web_path;?><?php echo $styledir;?>/1000ask.gif" width="147" height="58" border="0" /></a></td>
    <TD width="1132">
      <DIV class=Tit><SPAN class=B>问题互助</SPAN></DIV>
      <FORM name=wordform onSubmit="return search_submit(this)" 
      action=search.php method=get>
      <DIV class=s_search_form><INPUT type=hidden name=sp> <INPUT type=hidden 
      name=ch> <INPUT class=search_input id=sb 
      onkeydown=userControl(this.value,this.id,event); 
      onkeyup=userInput(this.value,this.id,event); maxLength=100 name=word 
      autocomplete="off"></INPUT> <INPUT class=search_bt type=submit value=搜索答案 name=search> <INPUT class=ask_bt onclick=ask_submit(); type=button value="提 问" name=ask></INPUT> 
      </DIV></FORM></TD></TR></TBODY></TABLE></DIV><BR>