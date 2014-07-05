<?php
require "../global.php";
require "../cache/s_cate_array.php";
require_once("global.func.php");
require_once("search.class.php");
$s=intval($_GET["s"]);
$wd=$_GET["wd"];
$from_host=str_replace("http://","",GetSiteUrl($_SERVER['HTTP_REFERER']));
if($from_host!=$_SERVER['HTTP_HOST']){$wd=get_encoding($wd,"GB2312");}
$old_wd=$wd;
$wd=FilterSearch($wd);
if(strlen($wd)<=0){header("location:".$config["url"]);}
$wd_en=urlencode($wd);		
$is_site=false;					
//////////////////////
class runtime
{
    var $StartTime = 0;
    var $StopTime = 0;

    function get_microtime()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    function start()
    {
        $this->StartTime = $this->get_microtime();
    }

    function stop()
    {
        $this->StopTime = $this->get_microtime();
    }

    function spent()
    {
		 return round((0.015*$this->StopTime - 0.015*$this->StartTime) , 3);
    }

}

//例子
$runtime= new runtime;
$runtime->start();
////////////////////////////////////////////////////////////
?>
<!--STATUS OK-->
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $config["adtitle"];?>_<?php echo $wd;?></title>
<link rel="stylesheet" href="images/css.css" type="text/css">
<link rel="stylesheet" href="images/style.css" type="text/css">
<script language="javascript" src="global.js"></script>
<script src="jquery-jd.js" type="text/javascript"></script>
<script type="text/javascript">
<!--

   function htmlspecialchars(string){
     var data = [];
     for(var i = 0 ;i <string.length;i++) {
       data.push( "&#"+string.charCodeAt(i)+";");
     }
     if(data.length <= 14){
        return data.join("");
     }else{
        return data.slice(0,14).join("")+"..";
     }
   }

   function pview(obj){
        var stText=obj.innerHTML;
        var oPaNode=obj.parentNode.parentNode;
        var bHasFrame=oPaNode.getElementsByTagName("iframe");
        var h2=oPaNode.getElementsByTagName("h2")[0];
        var url=h2.getElementsByTagName("a")[0].getAttribute("href");
        if(stText=="预览"){
            if(bHasFrame.length==0){
                var p=document.createElement("p");
                p.className="viewD";
                var iframe=document.createElement("iframe");
                iframe.setAttribute("frameborder","0");
                iframe.setAttribute("SECURITY","restricted");
                iframe.setAttribute("src",url);
                iframe.setAttribute("allowtransparency","no");
                iframe.setAttribute("scrolling","auto");
                iframe.className="viewF";
                p.appendChild(iframe);
                oPaNode.appendChild(p);
            }else{
                bHasFrame[0].setAttribute("src",url);
                bHasFrame[0].style.display="block";
            }
            obj.className="view clview";
            obj.innerHTML="关闭预览";
        }else{
            bHasFrame[0].style.display="none";
            bHasFrame[0].setAttribute("src","");
            obj.className="view";
            obj.innerHTML="预览";
        }
    }
-->
</script>
<style type="text/css">
<!--
.ins {
	text-decoration: underline;
	font-size: 12px;
}
.nv A {
	COLOR: #0000cc
}
.i {
	BORDER-RIGHT: #b6b6b6 1px solid; PADDING-RIGHT: 7px; BORDER-TOP: #7b7b7b 1px solid; PADDING-LEFT: 7px; BACKGROUND: url(../images/i2.png) no-repeat; PADDING-BOTTOM: 3px; FONT: 16px arial; VERTICAL-ALIGN: top; BORDER-LEFT: #7b7b7b 1px solid; WIDTH: 519px; MARGIN-RIGHT: 5px; PADDING-TOP: 7px; BORDER-BOTTOM: #b6b6b6 1px solid; HEIGHT: 32px}
.btn {
	BORDER-TOP-WIDTH: 0px; PADDING-RIGHT: 0px; PADDING-LEFT: 0px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: url(../images/i2.png) #ddd 0px -35px; BORDER-BOTTOM-WIDTH: 0px; PADDING-BOTTOM: 0px; WIDTH: 95px; CURSOR: pointer; PADDING-TOP: 2px; HEIGHT: 32px; BORDER-RIGHT-WIDTH: 0px
}
.btn_h {
	BACKGROUND-POSITION: -100px -35px
}
.btn_wr {
	DISPLAY: inline-block; BACKGROUND: url(../images/i2.png) no-repeat -202px bottom; WIDTH: 97px; POSITION: relative; HEIGHT: 34px; _padding-top: 1px
}
#sc {
	MARGIN: 0px; WIDTH: 500px}
#s {
	POSITION: relative
}
#s {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s_input {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s_button {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s {
	BACKGROUND-POSITION: -85px 0px; PADDING-LEFT: 3px; MARGIN-BOTTOM: 0px; HEIGHT: 36px
}
#s_input {
	BORDER-TOP-WIDTH: 0px; PADDING-RIGHT: 5px; BACKGROUND-POSITION: -85px -36px; PADDING-LEFT: 5px; BORDER-LEFT-WIDTH: 0px; FLOAT: left; BORDER-BOTTOM-WIDTH: 0px; PADDING-BOTTOM: 4px; FONT: 16px Arial; WIDTH: 402px; PADDING-TOP: 10px; BACKGROUND-REPEAT: repeat-x; HEIGHT: 36px; BORDER-RIGHT-WIDTH: 0px
}
#s_button {
	BORDER-TOP-WIDTH: 0px; BACKGROUND-POSITION: 0px 0px; BORDER-LEFT-WIDTH: 0px; FLOAT: left; BORDER-BOTTOM-WIDTH: 0px; WIDTH: 85px; CURSOR: pointer; TEXT-INDENT: -9999px; HEIGHT: 36px; BORDER-RIGHT-WIDTH: 0px
}
.seth {
	DISPLAY: inline; MARGIN-LEFT: 22px
}
.seth A {
	COLOR: #00c
}
#tb_mr {
	Z-INDEX: 200; CURSOR: pointer; COLOR: #00c; POSITION: relative
}
#tb_mr B {
	FONT-WEIGHT: normal; TEXT-DECORATION: underline
}
#tb_mr SMALL {
	FONT-SIZE: 11px
}
#more {
	BORDER-RIGHT: #9a99ff 1px solid; BORDER-TOP: #9a99ff 1px solid; DISPLAY: none; Z-INDEX: 200; BACKGROUND: #fff; LEFT: 452px; OVERFLOW: hidden; BORDER-LEFT: #9a99ff 1px solid; WIDTH: 58px; BORDER-BOTTOM: #9a99ff 1px solid; POSITION: absolute; TOP: 46px; HEIGHT: 100px; outline: none
}
#more A {
	PADDING-RIGHT: 0px; DISPLAY: block; PADDING-LEFT: 7px; PADDING-BOTTOM: 0px; WIDTH: 53px; COLOR: #0001cf; LINE-HEIGHT: 24px; PADDING-TOP: 0px; HEIGHT: 25%; TEXT-DECORATION: none
}
#more A SPAN {
	FONT-FAMILY: "宋体"
}
#more A:hover {
	BACKGROUND: #d9e1f6
}
#more DIV {
	BACKGROUND: #ccf; MARGIN: 0px 3px; OVERFLOW: hidden; HEIGHT: 1px
}
#page {
	PADDING-RIGHT: 0px; PADDING-LEFT: 18px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; WHITE-SPACE: nowrap
}
#page {
	WORD-SPACING: 4px
}
#page .n {
	FONT-SIZE: 16px
}
#rs {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; BACKGROUND: #eff2fa; PADDING-BOTTOM: 8px; MARGIN: 20px 0px 0px; WIDTH: 100%; PADDING-TOP: 8px
}
#rs TD {
	WIDTH: 5%
}
#rs TH {
	FONT-WEIGHT: normal; FONT-SIZE: 14px; VERTICAL-ALIGN: top; LINE-HEIGHT: 19px; WHITE-SPACE: nowrap; TEXT-ALIGN: left
}
#rs .tt {
	PADDING-RIGHT: 10px; PADDING-LEFT: 23px; FONT-WEIGHT: bold; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
.to {
	PADDING-RIGHT: 0px; PADDING-LEFT: 58px; FONT-SIZE: 16px; PADDING-BOTTOM: 0px; MARGIN: 20px 0px 0px; LINE-HEIGHT: 24px; PADDING-TOP: 0px
}
#search {
	PADDING-RIGHT: 0px; PADDING-LEFT: 18px; PADDING-BOTTOM: 16px; PADDING-TOP: 35px
}
#search .btn_wr {
	VERTICAL-ALIGN: middle
}
#foot {
	BACKGROUND: #e6e6e6; COLOR: #77c; LINE-HEIGHT: 20px; HEIGHT: 20px; TEXT-ALIGN: center
}
#foot SPAN {
	COLOR: #666
}
.mo {
	FONT-SIZE: 100%; COLOR: #666; LINE-HEIGHT: 10px
}
A.mo:link {
	FONT-SIZE: 100%; COLOR: #666; LINE-HEIGHT: 10px
}
A.mo:visited {
	FONT-SIZE: 100%; COLOR: #666; LINE-HEIGHT: 10px
}
.htb {
	MARGIN-BOTTOM: 5px
}
.jc A {
	COLOR: #cc0000
}
A FONT[size='3'] FONT {
	TEXT-DECORATION: underline
}
FONT[size='3'] A FONT {
	TEXT-DECORATION: underline
}
DIV.blog {
	COLOR: #707070; PADDING-TOP: 3px
}
DIV.bbs {
	COLOR: #707070; PADDING-TOP: 3px
}
.result {
	TABLE-LAYOUT: fixed; WIDTH: 34em
}
.nums {
	FONT-SIZE: 12px; COLOR: #999
}
.tools {
	WIDTH: 220px; POSITION: absolute; TOP: 10px
}
#mHolder {
	DISPLAY: none; MARGIN-LEFT: 9px; WIDTH: 62px; MARGIN-RIGHT: -12px; POSITION: relative; TOP: -18px
}
#mCon {
	PADDING-RIGHT: 18px; PADDING-LEFT: 0px; RIGHT: 7px; BACKGROUND: url(../images/arr.gif) no-repeat right center; PADDING-BOTTOM: 0px; CURSOR: pointer; LINE-HEIGHT: normal; PADDING-TOP: 0px; POSITION: absolute; TOP: 6px
}
#mCon SPAN {
	DISPLAY: block; CURSOR: default; COLOR: #00c; PADDING-TOP: 3px
}
#mCon .hw {
	CURSOR: pointer; TEXT-DECORATION: underline
}
#mMenu {
	BORDER-RIGHT: #9a99ff 1px solid; BORDER-TOP: #9a99ff 1px solid; DISPLAY: none; RIGHT: 7px; BACKGROUND: #fff; BORDER-LEFT: #9a99ff 1px solid; WIDTH: 56px; BORDER-BOTTOM: #9a99ff 1px solid; POSITION: absolute; TOP: 28px
}
#mMenu A {
	DISPLAY: block; WIDTH: 100%; COLOR: #00c; TEXT-INDENT: 6px; LINE-HEIGHT: 22px; HEIGHT: 100%; TEXT-DECORATION: none
}
#mMenu A:hover {
	BACKGROUND: #d9e1f6
}
#mMenu .ln {
	FONT-SIZE: 1px; BACKGROUND: #ccf; MARGIN: 2px; OVERFLOW: hidden; LINE-HEIGHT: 1px; HEIGHT: 1px
}
.EC_mr15 {
	MARGIN-LEFT: 15px
}
.pd15 {
	PADDING-LEFT: 15px
}
.favurl {
	BACKGROUND-POSITION: 0px 1px; PADDING-LEFT: 20px; BACKGROUND-REPEAT: no-repeat
}
#cp {
	COLOR: #77c
}
#cp A {
	COLOR: #77c
}
#row1 { float: left; }
#l {margin:0 0 5px 15px}
#topmenu {
	height:25px;
	line-height:25px;
	border-bottom:1px solid #E4EDF9;
	text-align:left;
	padding-left:15px;
}
a:link {
	color: #0D00D3;
}
.STYLE10 {color: #CCCCCC}
.STYLE13 {color: #000000}
.STYLE14 {font-size: 80%}
.STYLE15 {color: #0000cc}
.STYLE16 {
	font-size: 18px;
	color: #000000;
}
-->
</style>
</head>
<body>
<p>
  <SCRIPT LANGUAGE="JavaScript">
<!--//屏蔽出错代码
function killErr(){
	return true;
}
window.onerror=killErr;
//-->
</SCRIPT>
<script type="text/javascript">
jQuery.fn.limit=function(){
	var self = $("[@limit]");
	self.each(function(){
		var objString = $(this).text();
		var objLength = $(this).text().length;
		var num = $(this).attr("limit");
		if(objLength > num){
                                                $(this).attr("title",objString);
			objString = $(this).text(objString.substring(0,num) + "...");
		}
	})
}
$(function(){
	$("[@limit]").limit();
})
</script>
<?php
$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by sort_id asc");
$is_do=true;
while($cate=$db->fetch_array($cate_query))
{
   $is_select=false;
   if($is_do)
   {
      if(!empty($s))
      {
         if($cate["cate_id"]==$s)
	    	{
		      $is_select=true;
		   }
      }
      else
      {
	      if(in_array($wd,$nav_cate_array[$cate["cate_id"]]))
          $is_select=true;
      }
   }
   if($is_select)
   {
	  $nav_selected="class=\"nav_selected\"";
	  $is_do=false;
	  $s=$cate["cate_id"];
	  $select_cate_id=array_keys($nav_cate_array[$cate["cate_id"]],$wd);
	  $select_cate_id=$select_cate_id[0];
	  //echo $select_cate_id;
   }
   else
   {
      $nav_selected="";
   }
   if(empty($cate["cate_url"]))
    {
       echo "<a href=\"../s?wd=".urlencode($cate["cate_title"])."&s=".$cate["cate_id"]."\" ".$nav_selected."><font color=\"#3366CC\">".$cate["cate_title"]."</a>";
    }
	else
	{
	   echo "<a href=\"".$cate["cate_url"]."=".urlencode($cate["cate_title"])."\" ".$nav_selected.">".$cate["cate_title"]."</a>";
	}
    echo "&nbsp;&nbsp;&nbsp;";

}
if(!stristr($wd,"site:")&&!stristr($wd,"http://")&&!stristr($wd,"")&&!stristr($wd,"?")&&!stristr($wd,"")&&!stristr($wd,"è")&&!stristr($wd,"")&&!stristr($wd,"")&&!stristr($wd,"|")&&!stristr($wd,"à")&&!stristr($wd,"ò")&&!stristr($wd,",")&&!stristr($wd,".")&&!stristr($wd,":")&&!stristr($wd,"`")&&!stristr($wd,"骗子")&&!stristr($wd,"垃圾")&&!stristr($wd,"")&&!stristr($wd,"a")&&!stristr($wd,"黄")&&!stristr($wd,"激")&&!stristr($wd,"狗"))
{
      $row=$db->get_one("select keyword from ve123_search_keyword where keyword='".$wd."'");
      if(empty($row))
      {
          $array=array('keyword'=>$wd,'s'=>$s,'hits'=>'1','lasttime'=>time());
      	$db->insert("ve123_search_keyword",$array);
      }
	  else
	  {
	     // $array=array('lasttime'=>time(),'hits'=>hits+1);
		 // $db->update("ve123_search_keyword",$array,"keyword='".$wd."'");
		 @$db->query("update ve123_search_keyword set lasttime='".time()."',hits=hits+1 where keyword='".$wd."'");
	  }
}
?>
</span></div>
<table width="100%" height="76" align="center" cellpadding="0" cellspacing="0">
<tr valign=middle>
<td width="100"><a href="../"><img src="../images/logo.gif" border="0" width="128" height="54" alt="到<?php echo $config["name"];?>首页"></a></td>
<td width="1300" valign="middle"><table cellspacing="0" cellpadding="0"> 
    <tr>
    <td width="794" nowrap><p class="f14 f14 f14 f14 f14">　<a href="../news/">新闻</a>　 <span class="STYLE13">网页</span>　 <a href="../tieba/create.php?name=<?php echo $wd;?>" class="STYLE15">贴吧</a>　 <a href="../zhidao/search.php?word=<?php echo $wd;?>" class="STYLE15">知道</a>　 <a href="http://shiwww.com/" class="STYLE15">门户</a>　 <a href="../image/" class="STYLE15">图片</a>　 <a href="../video/" class="STYLE15">视频</a>　 <a href="../map/" class="STYLE15">地图</a></p>
<DIV id=sc>
<DIV id=s>
<FORM id=flpage name=f action=/s>
  <INPUT name=wd id=s_input value="<?php echo $wd;?>" autocomplete="off" 
smartch="sb.c.idx" smartpid="sb.idx"> 
  <INPUT id=s_button type=submit> 
</FORM></DIV></DIV>

<a href="<?php echo $config["url"]."/tg/";?>"> 
</tr></table></td>
</tr><td height="2"></form></table>
<?php
//print_r($wd_split);
$pos = strstr(strtolower($wd),"site:");//echo $pos;
if (strlen($pos) > 5)
{ 
    $is_site=true;
	$domain=GetSiteUrl($wd);
	$domain=str_replace("site:","",$domain);
	
    $sql="select * from ve123_links where title<>'' and url like '%".str_replace("site:","",$domain)."%'"; 
	$sql_count="select link_id from ve123_links where title<>'' and url like '%".str_replace("site:","",$domain)."%'"; 
}
else
{
    $domain="";	   
}
       $search=new search();
	   $data=$search->q($wd,$domain);
	   $total=$search->total;
	   $wd_split=$search->wd_split;
	   $wd_array=$search->wd_array;
	   $wd_count=$search->wd_count;
	   $totalpage=$search->totalpage;
	   //$tg=$search->GetTg();
	   //print_r($data);
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bi">
<tr>
<td nowrap>&nbsp;&nbsp;&nbsp;<a onClick="h(this,'<?php echo $config["url"];?>')" href="#" style="color:#000000 ">把<?php echo $config["name"];?>设为主页</a></td>
<td align="right" nowrap><?php echo $config["name"];?>一下，找到相关网页约<?php echo $total;?>篇，<?php
$runtime->stop();
echo "(用时: ".$runtime->spent()."秒)";
?>
&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<p class="f14 f14 STYLE16"><strong>分类导航：</strong>
  <?php
  $result=$db->query("select * from ve123_fenlei order by about_id desc");
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <a href="<?php echo $config["url"];?>/list/?<?php echo stripslashes($rs["urlid"]);?>.html" target="_blank"><?php echo stripslashes($rs["title"]);?></a>&nbsp;|
  <?php
  }
  ?>
</p>
<p>
  <?php
RightAd();
?>
</p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="721" valign="top">
</div>
<div align="left" style="padding-left:1px; padding-right:50px;">
<?php echo file_get_contents("../open/html/$wd.html");?>
</div>
<?php
if($total>0)
{
  foreach($data as $link)
  {     
?>
<table width="800" border="0" cellpadding="0" cellspacing="0" id="1">
  <tr><td width="800" class=f>
            <p>
              <?php
			if($link["is_tg"]>0)
			{
			?>
</p>
            <DIV id=main>
<OL id=list>
  <LI>
    <DIV class=dig>
	<DIV class="a_d">
      <div align="left">
       <H2 align="left" style="font-size:18px;"><a href="<?php echo "click.php?".base64_encode("url=".$link["url"]."&link_id=".$link["link_id"]);?>" target="_blank"><?php echo $link["title"];?></a><br>
            </H2>
       <DIV class=dig>
         
          <div align="left" style="font-size:13px;">
            <?php
if(empty($link["description"]))
{
   echo $link["txt"];
}
else
{
   echo $link["description"];
}
 ?>
          </div>
       </DIV>
  </DIV>
  <P align="left" style="font-size:13px;"><CITE class=s2><?php echo $link["url"];?> - <?php
echo "<a href=\"".$config["url"]."/tg/\" target=\"_blank\" class=m><font class=m>推广链接</font></a>&nbsp;&nbsp;";
echo $link["jscode"];?>
  </CITE></P>
      </LI>
</OL>
</DIV>
            <?php
		   }
		   else
		   {
		   ?>
		   <OL id=list>
  <LI>
  <H2 align="left" class="STYLE10" style="font-size:18px;"><a href="<?php echo $link["url"]?>" target="_blank"style="color:#0D00D3"><?php echo $link["title"];?></a><br>
  </H2>
  <DIV class=dig>
    
      <div align="left" style="font-size:13px;">
        <?php echo $link["txt"];?>        </div>
  </DIV>
  <P align="left" style="font-size:14px;"><CITE class=s2><div limit="40" id="row1"><?php echo $link["url"];?></div>
  <?php echo $link["updatetime"];?>-<a href="../zhandian.php?<?php echo $link["link_id"];?>.html" target=\"_blank\" class=view STYLE14>站点信息</a>-<a href="<?php echo $config["url"]."/k/?".base64_encode("url=".$link["url"]."&wd=".$wd_split."");?>" target="_blank" class=view STYLE14> <?php echo $config["name"];?>快照</a>-</CITE><span class="STYLE14"><A class=view onClick="pview(this); return false;" href="<?php echo $link["url"];?>">预览</A>
  </P>
  </span></LI>
    </OL>
		   <?php
		   }
		   ?>
		   </td>
</tr></table>
<div align="center">
  <div align="left">
    <?php
         
    }  
?>	
<DIV id=page>
<DIV class=pg>
<?php
require_once(PATH."/include/inc_page.php");
$page = new Page($totalpage,"?wd=".$wd_en."&s=".$s."&p=");
echo $page->show();
?>
</div><br>
    <?php
}
else
{
?>
  </div>
  <div style="margin:0 0 0 15px;font-size:14px;line-height:20px;">
<?php
if(substr($wd,0,7)=="http://")
{
?>
您可以直接访问：<?php echo "<a target=\"_blank\" href=\"".$wd."\">".$wd."</a>";?><br>
<?php
}
else
{
?>

抱歉，没有找到与“<font color="#C60A00"><?php echo $wd;?></font>” 相关的网页。

<?php 
}
?>
<br><br>
<font class="fB"><?php echo $config["name"];?>建议您：</font>
<div style="margin-top:0px;margin-left:15px;">
<li>看看输入的文字是否有误</li>
<li>去掉可能不必要的字词，如“的”、“什么”等</li>
<li>阅读<a href="../search/noresult.php" target="_blank"><font color=\"#3366CC\">帮助</a></li>
<li><a href="../search/url_submit.php" target="_blank"><font color=\"#3366CC\">网站登录入口</a></li>
</div>
<div style="margin-top:0px;margin-left:15px;" id="DivPost"></div>
<?php
}
?>	
</table>
<DIV class="tj">
  <DIV ss_c="search.hint">
    <table cellspacing=0 cellpadding=0>
          <th valign=top rowspan=2><b>相关搜索</b> </th>
          <td valign=top><table border="0" cellpadding="0" cellspacing="0"><tr>
<?php
	    $sql="select * from ve123_search_keyword where";
	    for($i=0;$i<$wd_count;$i++)
		{
		      if($i==($wd_count-1))
			  {
			       $sql=$sql." keyword like '%".$wd_array[$i]."%'";
			  }
			  else
			  {
			       $sql=$sql." keyword like '%".$wd_array[$i]."%' or ";
			  }
		        
		}

$query=$db->query($sql." order by hits desc limit 10");
$j=0;
while($row_kw=$db->fetch_array($query))
{$j++;
?>
<td nowrap class="f14"><a href="?wd=<?php echo urlencode($row_kw["keyword"]);?>"><font color=\"#3366CC\"><?php echo str_cut($row_kw["keyword"],20,"");?></a></td>
<?php
    if($j%5==0)
	{
	   echo "</tr>";
	}
}
?>
</tr></table></td>
        </tr>
      </tbody>
    </table>
  </DIV>
</DIV>
<p>
  <?php if(!$is_site){?>
  <?php }?>
</p>
<DIV id=sc>
  <DIV id=s>
<FORM id=flpage name=f action=/s>
  <INPUT name=wd id=s_input value="<?php echo $wd;?>" autocomplete="off" 
smartch="sb.c.idx" smartpid="sb.idx"> 
  <INPUT id=s_button type=submit> 
</FORM></DIV></DIV>

<p>
  <?php
$u=intval($_GET["u"]);
if(!empty($u))
{
?>
</p>
<p>
  <?php
}
?>
  <?php
foothtml();
?>