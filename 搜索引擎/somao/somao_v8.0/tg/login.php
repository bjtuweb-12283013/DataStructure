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
<title><?php echo $zeigou["name"];?>推广</title>
<style type="text/css">
<!--
body,td,div {font-size:12px;font-family:Arial;color:#666;line-height:20px;}
form{margin:0}
img{border:0}
ul,li{margin:0;list-style:none;padding:0}
p{ padding:5px 0; margin:0}
a:link{color:#0000ee;text-decoration:none}
a:visited{color:#0000ee;text-decoration:none}
.f12{font-size:12px;line-height:18px}
.f14,.f14b{font-size:14px;line-height:24px}
.f14b{font-weight:bold}
body{margin:10px 0;}
#hd{width:760px;height:52px;margin:0 auto;}
#hd a:hover{text-decoration:underline;}
#main{width:760px;margin:0 auto;padding-top:5px}
.wl{width:489px;float:left;}
.wr{width:260px;float:right;}
.t1{background: url(images/login_1.gif) no-repeat left;font-size:12xp;font-weight:bold;color:#8b3b00;line-height:31px;height:31px; text-indent:13px}
.login1{border:1px solid #efd058;border-top:0;background:#ffeea7;padding:14px 15px 5px 15px}
.login2{border-left:1px solid #efd058;border-right:1px solid #efd058;background:#ffffff;padding:6px 15px;}
#bnr{width:760px;margin:10px auto; text-align:center}
.mar1{margin-top:5px}
.clear{height:0px;line-height:0px;font-size:0px;clear:both;visibility:visible;overflow:hidden}
#ft{width:760px;margin:auto;clear:both;padding-top:10px;line-height:20px;color:#999999;font-size:12px;font-family:Arial;text-align:center;}
#ft a,#ft a:link,#ft a:visited{color:#999999;text-decoration:underline}
-->
</style>
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
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="hd">
  <tr>
    <td valign="top"><a href="./"><img src="images/logo_e.gif" class="log"></a></td>
    <td align="right" valign="bottom"><a href="../">返回首页</a>&nbsp;&nbsp;<a href="#" onClick="javascript:window.external.addFavorite(window.location.href,document.title)">收藏本站</a>&nbsp;&nbsp;</td>
  </tr>
</table>

<div id="main">
<div class="wl">
  <a href="#" target="_blank"><img src="images/bnr_1.gif" ></a>
</div> 
<div class="wr">
<div class="t1">用户登录</div> 
<div class="login1">
	<form action='login.php' METHOD=post onSubmit="return checkData()">
	<input type="hidden" name="action" value="login">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
			<td height="20">&nbsp;</td>
			<td style='color:#f00;width:160px;'>
			<?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "请输入用户名";
			}
			else
			{
			    echo $msg;
			}
			?>
			</td>
		</tr>
		<tr>
		  <td height="38" class="f14">用户名：</td>
		  <td>
			<div style="background:url(http://www2.baidu.com/images/login_3.gif) no-repeat 1px 1px;width:168px;height:24px;*height:25px;*background-position:1px 2px;overflow:hidden;">
				<input type="text" name="entered_login" id="entered_login" value="" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; padding:3px; width:160px; height:16px; background:transparent;border:1px solid #cea773">
			</div>
		  </td>
		</tr>
		<tr>
		  <td height="38" class="f14">密　码：</td>
		  <td>
			<div style="background:url(http://www2.baidu.com/images/login_3.gif) no-repeat 1px 1px;width:168px;height:24px;*height:25px;*background-position:1px 2px;overflow:hidden;">
				<input type="password" name="entered_password" id="entered_password" style="padding:3px; width:160px; height:16px; background:transparent;border:1px solid #cea773">
		     </div>
		</tr>
		<tr>
		  <td height="38" class="f14">验证码：</td>
		  <td><input name="entered_imagecode" type="text" id="entered_imagecode" size="6" maxlength="4" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; padding:3px; height:16px; background:url(http://www2.baidu.com/images/login_3.gif) no-repeat left top;border:1px solid #cea773">
			&nbsp;<img src="../include/vdimgck.php" align="absmiddle"></td>
		</tr>
		<tr>
		  <td height="35">&nbsp;</td>
		  <td><input type="submit" name="button2" id="button2" value="登 录" style="font-size:14px; width:60px; height:26px">
			&nbsp;<a href="getpwd.php">找回密码</a></td>
		</tr>
	  </table>
	</form>
</div>
<div class="login2"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="26">还未参加<?php echo $zeigou["name"];?>推广？</td>
    </tr>
    <tr>
      <td height="40" align="center" valign="bottom">
		<a href="reg.php" title="立即注册">
			<img src="images/button_1.gif" style="vertical-align:middle">
		</a>
	  </td>
    </tr>
  </table>
  </div>
<div><img src="http://www2.baidu.com/images/login_2.gif" ></div>
</div>
<div class="clear"></div>
</div>

<div id="bnr">

</div>
<div id="ft">
<?php echo $zeigou["copyright"];?>  <a href="<?php echo $zeigou["url"];?>"><?php echo $zeigou["name"];?>首页</a>
</div>
</body>
<script type="text/javascript">
	<!--
	document.forms[0].entered_login.select();
	document.forms[0].entered_login.focus();
	//-->
</script>
</html>
