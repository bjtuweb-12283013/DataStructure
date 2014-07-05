<?php
require "global.php";
?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=gb2312">
<title><?php echo $config["name"];?>搜索引擎</title>
<meta name="Keywords" content="<?php echo $config["Keywords"];?>">
<meta name="description" content="<?php echo $config["description"];?>">
<link href="/favicon.ico" rel="shortcut icon" />
<STYLE>
HTML {
	OVERFLOW-Y: auto
}
BODY {
	TEXT-ALIGN: center; FONT: 12px arial; BACKGROUND: #fff
}
BODY {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
P {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
FORM {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
UL {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
LI {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}
BODY {
	POSITION: relative
}
FORM {
	POSITION: relative
}
#fm {
	POSITION: relative
}
TD {
	TEXT-ALIGN: left
}
IMG {
	BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px
}
A {
	COLOR: #00c
}
A:active {
	COLOR: #f60
}
#u {
	TEXT-ALIGN: right; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 10px; PADDING-TOP: 7px
}
#m {
	MARGIN: 0px auto; WIDTH: 680px
}
#nv {
	TEXT-ALIGN: left; TEXT-INDENT: 117px; MARGIN: 0px 0px 4px; FONT-SIZE: 16px
}
#nv A {
	FONT-SIZE: 14px
}
#nv B {
	FONT-SIZE: 14px
}
.btn {
	FONT-SIZE: 14px
}
#lk {
	FONT-SIZE: 14px
}
#fm {
	TEXT-ALIGN: left; PADDING-LEFT: 90px
}
#kw {
	BORDER-BOTTOM: #cdcdcd 1px solid; BORDER-LEFT: #9a9a9a 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 7px; WIDTH: 420px; PADDING-RIGHT: 7px; FONT: 16px arial; BACKGROUND: url(images/i-1.0.0.png) no-repeat -304px 0px; HEIGHT: 33px; VERTICAL-ALIGN: top; BORDER-TOP: #9a9a9a 1px solid; BORDER-RIGHT: #cdcdcd 1px solid; PADDING-TOP: 6px; _background-attachment: fixed
}
.btn {
	PADDING-BOTTOM: 0px; BORDER-RIGHT-WIDTH: 0px; PADDING-LEFT: 0px; WIDTH: 95px; PADDING-RIGHT: 0px; BACKGROUND: url(images/i-1.0.0.png) #ddd no-repeat; BORDER-TOP-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; HEIGHT: 32px; BORDER-LEFT-WIDTH: 0px; CURSOR: pointer; PADDING-TOP: 2px
}
.btn_h {
	BACKGROUND-POSITION: -100px 0px
}
#kw {
	MARGIN: 0px 5px 0px 0px
}
.btn_wr {
	MARGIN: 0px 5px 0px 0px
}
.btn_wr {
	POSITION: relative; WIDTH: 97px; DISPLAY: inline-block; BACKGROUND: url(images/i-1.0.0.png) no-repeat -202px 0px; HEIGHT: 34px; _top: 1px
}
#lk {
	MARGIN: 33px 0px
}
#lk SPAN {
	FONT: 14px "宋体"
}
#lm {
	HEIGHT: 60px
}
#lh {
	MARGIN: 16px 0px 5px; WORD-SPACING: 3px
}
#mCon {
	POSITION: absolute; PADDING-BOTTOM: 0px; LINE-HEIGHT: 18px; PADDING-LEFT: 0px; PADDING-RIGHT: 18px; BACKGROUND: url(images/i-1.0.0.png) no-repeat right -136px; HEIGHT: 18px; TOP: 10px; CURSOR: pointer; RIGHT: 7px; PADDING-TOP: 0px
}
#mCon SPAN {
	DISPLAY: block; COLOR: #00c; CURSOR: default
}
#mCon .hw {
	CURSOR: pointer; TEXT-DECORATION: underline
}
#mMenu {
	BORDER-BOTTOM: #9a99ff 1px solid; POSITION: absolute; BORDER-LEFT: #9a99ff 1px solid; LIST-STYLE-TYPE: none; WIDTH: 56px; DISPLAY: none; BACKGROUND: #fff; BORDER-TOP: #9a99ff 1px solid; TOP: 28px; RIGHT: 7px; BORDER-RIGHT: #9a99ff 1px solid
}
#mMenu A {
	LINE-HEIGHT: 22px; TEXT-INDENT: 6px; WIDTH: 100%; DISPLAY: block; HEIGHT: 100%; TEXT-DECORATION: none
}
#mMenu A:hover {
	BACKGROUND: #d9e1f6
}
#mMenu .ln {
	LINE-HEIGHT: 1px; MARGIN: 2px; BACKGROUND: #ccf; HEIGHT: 1px; FONT-SIZE: 1px; OVERFLOW: hidden
}
#cp {
	COLOR: #77c
}
#cp A {
	COLOR: #77c
}
#sh {
	DISPLAY: none; BEHAVIOR: url(#default#homepage)
}
#user {
	POSITION: relative; DISPLAY: inline-block; COLOR: #00c; CURSOR: pointer
}
#user STRONG {
	TEXT-DECORATION: underline
}
#user UL {
	BORDER-BOTTOM: #9a99ff 1px solid; POSITION: absolute; BORDER-LEFT: #9a99ff 1px solid; WIDTH: 67px; DISPLAY: none; BACKGROUND: #fff; BORDER-TOP: #9a99ff 1px solid; TOP: 18px; RIGHT: 0px; BORDER-RIGHT: #9a99ff 1px solid
}
#user LI {
	BORDER-BOTTOM: #e6e6e6 1px solid; HEIGHT: 22px
}
#user LI A {
	TEXT-ALIGN: left; TEXT-INDENT: 10px; WIDTH: 100%; DISPLAY: block; HEIGHT: 17px; TEXT-DECORATION: none; PADDING-TOP: 5px
}
#user LI A:hover {
	BACKGROUND: #d9e1f6
}
#user LI.nl {
	BORDER-BOTTOM-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-TOP-STYLE: none; BORDER-LEFT-STYLE: none
}
</STYLE>
<script language="javascript" type="text/javascript">
function selectTag(showContent,wd,cate_id,selfObj){
	var tag = document.getElementById("tags").getElementsByTagName("a");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.className = "focu";
	
	document.f.wd.focus();
	document.f.wd.value=wd;
	document.f.s.value=cate_id;
	f.attributes[83].value=showContent;
	//document.f.action=showContent;

}
function selectTag_tieba(showContent,wd,cate_id,selfObj){
	var tag = document.getElementById("tags").getElementsByTagName("a");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.className = "focu";
	
	document.f.wd.focus();
	document.f.wd.value=wd;
	document.f.s.disabled="disabled";
	f.attributes[83].value=showContent;
	document.f.wd.name="kw";
	//document.f.action=showContent;

}
</script>
<script language="javascript" src="js/somao_menu.php"></script>
<META content="MSHTML 6.00.6000.17093" name=GENERATOR></HEAD>
<BODY>
<P id=u></P>
<DIV id=m>
<P id=lg>&nbsp;</P>
<P><IMG src="images/logo.gif" width=270 height=129 useMap=#mp></P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P id=nv>　<B>网&nbsp;页</B> </P>
<DIV id=fm>
<FORM name=f action=/s>
<INPUT id=kw maxLength=100 name=wd>
<SPAN class=btn_wr>
<INPUT id=su class=btn onMouseOut="this.className='btn'" onMouseDown="this.className='btn btn_h'" value=<?php echo $config["name"];?>一下 type=submit>
</SPAN>
</FORM>
<UL id=mMenu>
  <LI class=ln>
  <LI></LI></UL></DIV>
<P id=lk><?php
$query_ad=$db->query("select * from ve123_ad where type='3' and is_show order by sortid asc");
while($row_ad=$db->fetch_array($query_ad))
{
  if(empty($row_ad["siteurl"]))
  {
     $urllink="s/?wd=".urlencode($row_ad["title"]);
  }
  else
  {
     $urllink=$row_ad["siteurl"];
  }
   echo "<a target=\"_blank\" href=\"".$urllink."\"><font color=\"#0B0BD5\">".str_cut($row_ad["title"],300)."</font></a>&nbsp;|&nbsp;";
}
?> </SPAN></P>
<P id=lm></P>
<P><A id=sh onMouseDown="return ns_c({'fm':'behs','tab':'homepage','pos':0})" 
onclick="this.setHomePage('<?php echo $config["url"];?>')" 
href="<?php echo $config["url"];?>">把<?php echo $config["name"];?>设为主页</A></P>
<P id=lh>
<?php
index_foothtml();?>
</P>
</DIV>
<MAP name=mp>
  <AREA title="<?php echo $config["name"];?>搜索引擎"  href="../" shape=rect target=_blank coords=41,24,225,93>
</MAP>
</center>
<SCRIPT src="css/bg.js" type=text/javascript></SCRIPT>
<SCRIPT src="yuegaima/autocomplete.r171052.js" type=text/javascript></SCRIPT>
<SCRIPT src="yuegaima/home.1.6.4.js" type=text/javascript></SCRIPT>
<div id="statcode" class="STYLE3"><?php echo $config["statcode"];?></div>
<SCRIPT>var w=window,d=document,n=navigator,k=d.f.wd,a=d.getElementById("nv").getElementsByTagName("a"),isIE=n.userAgent.indexOf("MSIE")!=-1&&!window.opera,sh=d.getElementById("sh");if(isIE&&sh&&!sh.isHomePage("http://www.baidu.com/")){sh.style.display="inline"}for(var i=0;i<a.length;i++){a[i].onclick=function(){if(k.value.length>0){var C=this,A=C.href,B=encodeURIComponent(k.value);if(A.indexOf("q=")!=-1){C.href=A.replace(/q=[^&$]*/,"q="+B)}else{this.href+="?q="+B}}}}(function(){if(/q=([^&]+)/.test(location.search)){k.value=decodeURIComponent(RegExp.$1)}})();if(n.cookieEnabled&&!/sug?=0/.test(d.cookie)){d.write('<script src=http://www.baidu.com/js/bdsug.js?v=1.0.3.0><\/script>')}function addEV(C,B,A){if(w.attachEvent){C.attachEvent("on"+B,A)}else{if(w.addEventListener){C.addEventListener(B,A,false)}}}</SCRIPT>
<SCRIPT type=text/javascript src="images/hps-1.1.1.js"></SCRIPT>
</BODY></HTML>
