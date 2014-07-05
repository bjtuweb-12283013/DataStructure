<?php

require_once('global.php');
is_login();
$pagetitle='加盟代码';
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页--';echo $pagetitle;;echo '</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" /> 
<script language="JavaScript">
<!--

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location=\'"+args[i+1]+"\'");
}
function JM_cc(ob){
var obj=MM_findObj(ob); if (obj) { 
obj.select();
alert("复制代码成功");
js=obj.createTextRange();js.execCommand("Copy");}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
//-->
</script>    
	</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100">链接方式</td>
    <td>
	  <textarea id="code_1" name="textfield" cols="60" rows="6">&lt;a href="';echo $config['url'].'/?u='.$user['user_id'];;echo '" target="_blank"&gt;';echo $config['name'];;echo '&lt;/a&gt;</textarea>
	<input onclick="JM_cc(\'code_1\')" type="submit" name="Submit" value="复制代码">
	(每次有IP点入加1分)</td>
  </tr>
  <tr>
    <td>搜索方式</td>
    <td><textarea id="code_2" name=textarea rows=6 cols=60>&lt;form action="';echo $config['url'];;echo '/s/" target="_blank"&gt;
&lt;table bgcolor="#FFFFFF"&gt;&lt;tr&gt;&lt;td&gt;
&lt;a href="';echo $config['url'];;echo '/"&gt;&lt;img src="';echo $config['url'];;echo '/images/logo-80px.gif" alt="config" align="bottom" border="0"&gt;&lt;/a&gt;
&lt;input type=text name=wd size=30&gt;
&lt;input type="submit" value="';echo $config['name'];;echo '搜索"&gt;
&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;
&lt;/form&gt;</TEXTAREA>
    <input onclick="JM_cc(\'code_2\')" type="submit" name="Submit" value="复制代码">(每个IP搜索量加2分)	</td>
  </tr>
</table>

'
?>