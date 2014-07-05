<?php
session_start();
require("global.php");
$action=$_REQUEST["action"];
switch($action)
{
    case "login":
	        $user_name=trim(HtmlReplace($_POST["entered_login"]));
			$password=trim(HtmlReplace($_POST["entered_password"]));
			$imagecode=trim(HtmlReplace($_POST["entered_imagecode"]));
	        $check=$db->get_one("select * from ve123_zz_user where user_name='".$user_name."' and password='".md5($password)."'");
	        if(empty($check))
	        {
			     header("location:login.php?msg=".urlencode("用户名或密码错误!"));
			}
			elseif($_SESSION['dd_ckstr']!=$imagecode)
			{
			     header("location:login.php?msg=".urlencode("验证码错误!"));
			}
			else
			{
			    $_SESSION["user_name"]=$user_name;
		        header("location:./");
			}
	break;
	case "logou":
	      unset($_SESSION["user_name"]);
	break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $config["name"];?>搜索开放平台</title>
<META http-equiv=Content-Type content="text/html; charset=gbk"><LINK 
href="images/index_old.css" type=text/css rel=stylesheet><LINK 
href="images/general_old.css" type=text/css rel=stylesheet>
<script language="JavaScript">
<!--
function SymError()
{
  return true;
}
window.onerror = SymError;
//-->
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
//  ------ check form ------
function checkData() {
	var f1 = document.forms[0];
	var wm = "对不起，您忘记输入了：";
	var noerror = 1;

	// --- entered_login ---
	var t1 = f1.entered_login;
	if (t1.value == "" || t1.value == " ") {
		wm += "用户名，";
		noerror = 0;
	}

	// --- entered_password ---
	var t1 = f1.entered_password;
	if (t1.value == "" || t1.value == " ") {
		wm += "密码，";
		noerror = 0;
	}

	var t1 = f1.entered_imagecode;
	if (t1.value == "" || t1.value == " ") {
		wm += "验证码，";
		noerror = 0;
	}

	// --- check if errors occurred ---
	if (noerror == 0) {
		alert(wm.substr(0, wm.length-1));
		return false;
	}
	else return true;
}

//-->
</SCRIPT>

<META content="MSHTML 6.00.2900.5969" name=GENERATOR>
<style type="text/css">
<!--
.STYLE1 {
	font-family: "宋体";
	color: #FF0000;
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
</HEAD>
<BODY>
<DIV class=main>
<DIV id=wrapper>
<DIV id=header>
<DIV class=header_left><A href="../open"><IMG 
src="../images/log.gif" width="110" height="40"></A><IMG style="MARGIN: 0px 15px" 
src="images/line.gif"><A href="../open"><IMG 
src="images/logoword.gif"></A> </DIV>
</DIV>
<DIV style="CLEAR: both"></DIV>
<DIV id=container>
<DIV id=content>
<DIV id=content_inner1></DIV>
<DIV id=content_inner2>
<DIV class=title><span class="STYLE1"><?php echo $config["name"];?>搜索开放平台是什么？</span></DIV>
<DIV 
class=ci><?php echo $config["name"];?>搜索开放平台是一个基于<?php echo $config["name"];?>网页搜索的开放的数据分享平台，广大站长和开发者，<BR>可以直接提交结构化的数据到<?php echo $config["name"];?>搜索引擎中，实现更强大、更丰富的应用，使用户获得更好<BR>的搜索体验，并获得更多有价值的流量。<BR><BR>在经过必要的申请、审核后，可以通过开放平台实现的特色功能有：<BR>·指定关键词，更精确、更直接的影响目标用户；<BR>·指定排序位置，更统一、更全面的展现内容；<BR>·指定样式，更丰富、更恰当的适应资源本身，不局限于文字；<BR>·指定更新频率，与<?php echo $config["name"];?>搜索结果保持及时同步。<BR><BR>
以下是“<A 
href="../s/?wd=360安全卫士" 
target=_blank>360安全卫士</A>”的实例：</DIV>
<DIV class=ci2><LABEL>更多实例：</LABEL> 
  <A 
href="../s/?wd=日历" target=_blank>日历</A> <A 
href="../s/?wd=2010世界杯" 
target=_blank>2010世界杯</A> <A 
href="../s/?wd=卡巴斯基" 
target=_blank>卡巴斯基</A> <SPAN>......</SPAN> </DIV>
</DIV>
<DIV id=content_inner3>
<DIV class=title><span class="STYLE1"><?php echo $config["name"];?>搜索开放平台欢迎什么样的资源加入？</span></DIV>
<DIV 
class=ci2>为保障最终的用户体验及平台的持续健康发展，因此对数据资源有严格要求：<BR><BR>·目前只接受“确定性”数据资源。<BR>·对于数据，要求精确、全面，并且更新及时；<BR>·对于服务，要求高度的稳定性，和快速的响应时间。<BR><BR></DIV>
<DIV 
class=ci3><SPAN>“确定性”资源</SPAN>是指标准的、明确的，具有唯一值的数据，例如：<BR>“今日人民币汇率”、“本周NBA赛程”等。其它非标准性的数据，将今后逐步放开。 
</DIV></DIV>
<DIV id=content_inner4>
<DIV class=title><IMG title=我想要使用，该如何操作？ src="images/left_title3.gif"> 
</DIV>
<DIV class=ci><A class=step1off onMouseOver="changClassname(this,'1')" 
onmouseout="changClassname(this,'1')" 
href="http://www.baidu.com/search/open_help.html#n2" 
target=_blank>注册平台<BR>验证您的网站 </A><A class=step2off 
onmouseover="changClassname(this,'2')" onMouseOut="changClassname(this,'2')" 
href="http://www.baidu.com/search/open_help.html#s1" 
target=_blank>确定展现样式<BR>指定更新周期 </A><A class=step3off 
onmouseover="changClassname(this,'3')" onMouseOut="changClassname(this,'3')" 
href="http://www.baidu.com/search/open_help.html#s2" 
target=_blank>提交资源数据<BR>等待审核</A> <A class=step4off 
onmouseover="changClassname(this,'4')" onMouseOut="changClassname(this,'4')" 
href="http://www.baidu.com/search/open_help.html#s3" 
target=_blank>审核通过<BR>在线上展现</A> </DIV></DIV>
<DIV style="FONT-SIZE: 12px"><IMG style="MARGIN: 0px 8px; VERTICAL-ALIGN: -2px" 
src="images/send_email.gif">对平台有任何意见或建议，请致电我们！！！</DIV>
</DIV>
<DIV id=aside>
<DIV class=aside_inner1>
<form action='login.php' METHOD=post onSubmit="return checkData()">
	<input type="hidden" name="action" value="login">
	  <table width="90%" border="0" cellspacing="0" cellpadding="0" style="padding-left:20px; padding-top:10px;">
	  <tr>
			<td height="20" colspan="2">
			  <?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "注册用户请登录";
			}
			else
			{
			    echo $msg;
			}
			?>			</td>
			</tr>
		<tr>
		  <td height="20" class="f14">用户名：</td>
		  <td>
			
				<input type="text" name="entered_login" class=txt>
			    </td>
		</tr>
		<tr>
		  <td height="20" class="f14">密　码：</td>
		  <td>
			
				<input type="password" name="entered_password" class=txt>
	     	  </tr>
		<tr>
		  <td height="20" class="f14">验证码：</td>
		  <td><input name="entered_imagecode" type="text" id="entered_imagecode" size="6" maxlength="4">
			&nbsp;<img src="../include/vdimgck.php" align="absmiddle"></td>
		</tr>
		<tr>
		  <td height="35">&nbsp;</td>
		  <td><input type="submit" name="button2" id="button2" value="" class=login_button onclick="javascript:window.location.href='open/reg.php'">
			&nbsp;<a href="getpwd.php" style="MARGIN-TOP: -2px; FONT-SIZE: 12px; MARGIN-LEFT: 10px; VERTICAL-ALIGN: text-top" >找回密码</a></td>
		</tr>
	  </table>
	</form>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<FORM action=register.php method=get>
<DIV class=title>没有平台帐号?</DIV>
<div align="center"><a href="reg.php" title="立即注册" target="_blank">
  <img src="images/reg.gif" style="vertical-align:middle">
  </a></div>
</FORM></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV class=aside_inner2><SPAN class=t1>最新热点</SPAN> 
<DIV class=ci1>·<A href="http://open.baidu.com/coop/kefu.html" 
target=_blank>平台开放收录客服电话资源</A><SUP>new</SUP><BR>·<A 
href="http://open.baidu.com/coop/xiazai.html" 
target=_blank>平台开放收录下载类资源</A><SUP>new</SUP><BR></DIV></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV class=aside_inner2><SPAN class=t1>常见问题</SPAN> 
<DIV class=ci1>·<A href="#" 
target=_blank><?php echo $config["name"];?>搜索开放平台与sitemap有何区别？</A><BR>·<A 
href="#" 
target=_blank>资源收录的标准是什么？</A><BR>·<A 
href="#" 
target=_blank>如何提交资源，资源提交流程是什么？</A><BR>·<A 
href="#" 
target=_blank>资源提交后多久会生效？</A><BR>·<A 
href="#" 
target=_blank>我可以提交多个资源么？</A><BR>·<A 
href="#" 
target=_blank>需要新的展现样式？</A><BR>·<A 
href="#" 
target=_blank>哪些问题容易被我忽略？</A><BR>·<A 
href="#" 
target=_blank>资源上线后我能监控展现情况么？</A><BR>　 <SPAN 
style="FONT-WEIGHT: bold; COLOR: #0055ba; FONT-FAMILY: 宋体"><A 
href="#" 
target=_blank>更多&gt;&gt;</A></SPAN> </DIV>
<DIV 
style="MARGIN-TOP: 1.5em; MARGIN-LEFT: 25px; LINE-HEIGHT: 180%">还有其他问题？<BR>欢迎进入<A 
style="COLOR: #0055ba" 
href="http://shiwww.com/bbs/" 
target=_blank><?php echo $config["name"];?>搜索开放平台论坛</A>讨论。 </DIV></DIV>
<DIV style="CLEAR: both"></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV style="MARGIN-TOP: 20px; TEXT-ALIGN: center"><A title=点击进入 
href="http://x.baidu.com/" target=_blank></A> </DIV>
</DIV>
<DIV style="CLEAR: both"></DIV></DIV>
<DIV id=footer>
<P class=b>&copy;2010  &nbsp;&nbsp;&nbsp;&nbsp; <A 
href="#">使用<?php echo $config["name"];?>搜索引擎前必读</A> <A 
href="http://www.miibeian.gov.cn/" target=_blank><?php echo $config["icp"];?></A><IMG 
src="images/gs.gif"> </P>
</DIV></DIV></DIV></BODY></HTML>
