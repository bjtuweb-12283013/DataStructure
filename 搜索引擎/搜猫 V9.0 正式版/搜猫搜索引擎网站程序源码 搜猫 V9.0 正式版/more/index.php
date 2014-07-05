<?php
require "global.php";
?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=gb2312">
<title><?php echo $config["name"];?>产品大全</title>
<meta name="Keywords" content="<?php echo $config["Keywords"];?>">
<meta name="description" content="<?php echo $config["description"];?>">
<link href="/favicon.ico" rel="shortcut icon" />
<STYLE>BODY {
	MARGIN: 6px 0px 4px
}
UL {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
LI {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
#main {
	MIN-WIDTH: 630px; MAX-WIDTH: 1004px
}
FORM {
	MARGIN: 0px
}
#hd {
	BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; WIDTH: 100%; MARGIN-BOTTOM: 7px; BORDER-TOP: 0px; BORDER-RIGHT: 0px
}
#hd TD {
	FONT-FAMILY: Arial; FONT-SIZE: 12px
}
.i {
	FONT-FAMILY: Arial; FONT-SIZE: 12px
}
#hd A {
	COLOR: #0000cc
}
#hd .lg {
	BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; MARGIN: 0px 9px 0px 8px; BORDER-TOP: 0px; BORDER-RIGHT: 0px
}
#hd .ch {
	HEIGHT: 21px; FONT-SIZE: 14px
}
#hd .i {
	FONT-SIZE: 16px
}
#ft {
	TEXT-ALIGN: center; LINE-HEIGHT: 20px; CLEAR: both
}
#ft {
	FONT-FAMILY: Arial; WHITE-SPACE: nowrap; COLOR: #77c; FONT-SIZE: 12px
}
#ft * {
	FONT-FAMILY: Arial; WHITE-SPACE: nowrap; COLOR: #77c; FONT-SIZE: 12px
}
.clear {
	LINE-HEIGHT: 0px; HEIGHT: 0px; VISIBILITY: visible; CLEAR: both; FONT-SIZE: 0px; OVERFLOW: hidden
}
A:link {
	COLOR: #0000cc
}
A:visited {
	COLOR: #800080
}
TD {
	LINE-HEIGHT: 18px; FONT-SIZE: 12px
}
.bi {
	BACKGROUND-COLOR: #d9e1f7; HEIGHT: 20px
}
#list {
	COLOR: #000
}
#list H3 {
	TEXT-ALIGN: left; PADDING-BOTTOM: 0px; LINE-HEIGHT: 24px; MARGIN: 0px; PADDING-LEFT: 10px; PADDING-RIGHT: 0px; HEIGHT: 24px; FONT-SIZE: 14px; PADDING-TOP: 0px
}
#list TABLE {
	MARGIN-BOTTOM: 10px
}
#list TD {
	LINE-HEIGHT: 24px; PADDING-LEFT: 10px; HEIGHT: 40px; VERTICAL-ALIGN: top
}
#list A {
	FONT-SIZE: 14px
}
#list SUP {
	FONT-FAMILY: arial; COLOR: red; FONT-SIZE: 12px; FONT-WEIGHT: bold; TEXT-DECORATION: none
}
#list TD IMG {
	BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; MARGIN: 0px 8px 0px 0px; FLOAT: left; BORDER-TOP: 0px; BORDER-RIGHT: 0px
}
#list A.bt {
	BORDER-BOTTOM: #f7941c 1px solid; BORDER-LEFT: #f7941c 1px solid; PADDING-BOTTOM: 2px; BACKGROUND-COLOR: #fef4e8; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; WHITE-SPACE: nowrap; FONT-SIZE: 12px; BORDER-TOP: #f7941c 1px solid; FONT-WEIGHT: normal; BORDER-RIGHT: #f7941c 1px solid; PADDING-TOP: 2px
}
.bi1 {
	BACKGROUND-COLOR: #d9e1f7; MARGIN-BOTTOM: 12px; HEIGHT: 20px
}
</STYLE>

<SCRIPT>
function h(obj,url){
obj.style.behavior='url(#default#homepage)';
obj.setHomePage(url);
}
</SCRIPT>

<META name=GENERATOR content="MSHTML 8.00.6001.19120"></HEAD>
<BODY onload=document.f.wd.focus()>
<CENTER>
<DIV id=main>
<FORM name=f action=../s><INPUT value=gb2312 type=hidden 
name=ie> <INPUT type=hidden name=bs> <INPUT type=hidden name=sr> <INPUT 
type=hidden name=z> <INPUT value=3 type=hidden name=cl> <INPUT value=8 
type=hidden name=f> 
<TABLE width="101%" cellPadding=0 cellSpacing=0 id=hd>
  <TBODY>
  <TR>
    <TD vAlign=top width=136><A href="../"><IMG src="../images/log.gif" 
      alt=到百度首页 width="110" height="40" border="0" class=lg></A></TD>
    <TD width="1010" vAlign=top noWrap>
      <DIV class=ch><A href="../news/"> 新闻</A>&nbsp;&nbsp;&nbsp;<A 
      style="COLOR: #000; TEXT-DECORATION: none" 
      href="../"><STRONG>网页</STRONG></A>&nbsp;&nbsp;&nbsp;<A 
      href="../tieba/">贴吧</A>&nbsp;&nbsp;&nbsp;<A 
      href="../zhidao/">知道</A>&nbsp;&nbsp;&nbsp;<A 
      href="http://shiwww.com/">门户</A>&nbsp;&nbsp;&nbsp;<A 
      href="../image/">图片</A>&nbsp;&nbsp;&nbsp;<A 
      href="../video/">视频</A></DIV>
      <TABLE border=0 cellSpacing=0 cellPadding=0>
        <TBODY>
        <TR>
          <TD vAlign=top noWrap><input name=wd id=kw size="42" class="i" style="height:29px" value="<?php echo $wd;?>" maxlength="100">&nbsp;<input name="submit2" type=submit style="height:29px" value=<?php echo $config["name"];?>一下></TD>
      <TD noWrap>&nbsp;</TD>
        </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM><!--[if IE]>
<SCRIPT>
function updatesize(){ var o = document.getElementById("main"); var w = document.body.offsetWidth; if(w<=650) o.style.width="630px"; else if(w<800) o.style.width="100%"; else if(w>1024) o.style.width="1004px"; else o.style.width="100%"; }
window.onresize = updatesize; updatesize();
</SCRIPT>
<![endif]-->
<TABLE class=bi1 border=0 cellSpacing=0 cellPadding=0 width="100%" 
  align=center><TBODY>
  <TR>
    <TD style="FONT-FAMILY: arial" noWrap>&nbsp;&nbsp;&nbsp;<A 
      style="COLOR: #000000" onClick="h(this,'../more/')" 
      href="../more/#">把本页设为首页</A></TD>
    <TD noWrap align=right>&nbsp;</TD></TR></TBODY></TABLE>
<DIV id=list align=left>
<H3>搜索与导航</H3>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" align=center>
  <TBODY>
  <TR>
    <TD width=130><A href="../"><IMG alt=网页 
      src="images/ico_www.gif">网页</A></TD>
    <TD width=130><A href="../video/"><IMG alt=视频搜索 
      src="images/ico_shipin.gif">视频搜索</A></TD>
    <TD width=130><A href="http://shiwww.com/"><IMG alt=MP3 
      src="images/ico_mp3.gif">门户</A></TD>
    <TD width=130><A href="../map/"><IMG alt=地图 
      src="images/ico_map.gif">地图</A></TD>
    <TD width=130><A href="../news/"><IMG alt=新闻 
      src="images/ico_news.gif">新闻</A></TD>
    <TD width=130><A href="../image/"><IMG alt=图片 
      src="images/ico_image.gif">图片</A></TD>
    <TD width=130><A href="../soumao/"><IMG 
      src="images/ico_www.gif" alt=图片 width="24" height="24">全能搜索</A></TD>
    <TD>&nbsp;</TD></TR>
  <TR>
    <TD><A href="http://www.shiwww.com/"><IMG alt=MP3 
      src="images/ico_mp3.gif">亿时达</A></TD>
    <TD><A href="../site/"><IMG alt=网站导航 
      src="images/ico_site.gif">网站导航</A></TD>
    <TD><A href="../s/newsite.php"><IMG 
      src="images/ico_app.gif" alt=网站导航 width="24" height="24">最新收录</A></TD>
    <TD><A href="../mp31/"></A></TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD></TR></TBODY></TABLE>
<H3>搜索社区</H3>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" align=center>
  <TBODY>
  <TR>
    <TD width=130><A href="../zhidao/"><IMG alt=知道 
      src="images/ico_zhidao.gif">知道</A></TD>
    <TD width=130><A href="http://shiwww.com/bbs/"><IMG alt=百科 
      src="images/ico_baike.gif">论坛</A></TD>
    <TD width=130><A href="../tieba/"><IMG alt=贴吧 
      src="images/ico_post.gif">贴吧</A></TD>
  <TR>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD></TR></TBODY></TABLE>
<H3>网站与企业服务</H3>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" align=center>
  <TBODY>
  <TR>
    <TD width=130><A href="../open/"><IMG alt=搜索开放平台 
      src="images/ico_open.gif">搜索开放平台</A></TD>
    <TD width=130><A href="../tg/"><IMG alt=百度推广 
      src="images/ico_tuiguang.gif">亿时达推广</A></TD>
    <TD width=130><A href="../top/"><IMG alt=风云榜 
      src="images/ico_top.gif">风云榜</A></TD>
    <TD>&nbsp;</TD></TR>
  <TR>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD>
    <TD>&nbsp;</TD></TR></TBODY></TABLE></DIV><BR><BR>
<HR style="WIDTH: 96%; BORDER-TOP: #ddd 1px solid" SIZE=0>

<DIV id=ft>&copy;2012 1230530.Com <A 
href="../a/mianze.html">使用前必读</A></DIV>
</BODY></HTML>
