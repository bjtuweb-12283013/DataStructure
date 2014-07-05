<?php

session_start();
require '../global.php';
$action=$_GET['action'];
switch($action)
{
case 'checklogin':
checklogin();
break;
case 'logou':
logou();
break;
}
function checklogin()
{
global $db;
$adminname=htmlspecialchars($_POST['adminname']);
$password=htmlspecialchars($_POST['password']);
$imagecode=trim(HtmlReplace($_POST['entered_imagecode']));
if($_SESSION['dd_ckstr']!=$imagecode)
{
jsalert('验证码错误!','login.php');
break;
}
$result=$db->query("select * from ve123_admin where adminname='$adminname' and password='$password'");
$num=$db->num_rows($result);
if ($num>0)
{
$rs=$db->fetch_array($result);
$array=array('lastloginip'=>$rs['loginip'],'loginip'=>ip(),'lastlogintime'=>$rs['logintime'],'logintime'=>date('Y-y-d H:i:s'));
$db->update('ve123_admin',$array,"admin_id=$rs[admin_id]");
setcookie('adminname',$adminname);
header('location:index.php');
}
else
{
jsalert('用户名或密码错误!','login.php');
}
}
function logou()
{
setcookie('adminname','',time()-3600);
header('location:login.php');
}
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE></TITLE>
<META content=亿时达搜索引擎管理系统 name=keywords>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="images/default.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript>
    function delcfm() {
        if (!confirm("确认要删除？")) {
            window.event.returnValue = false;
        }
   }
</SCRIPT>

<STYLE type=text/css>
BODY {
	BACKGROUND: url(images/idmax_bg1.gif) repeat-x 50% top; MARGIN: 0px
}
TD {
	FONT-SIZE: 12px; COLOR: #666
}
.table {
	BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: #fff; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px
}
.input {
	BORDER-RIGHT: #82b2c7 1px solid; BORDER-TOP: #82b2c7 1px solid; PADDING-LEFT: 10px; FONT-SIZE: 12px; BACKGROUND-IMAGE: url(images/input_bg_29.gif); BORDER-LEFT: #82b2c7 1px solid; WIDTH: 138px; LINE-HEIGHT: 19px; BORDER-BOTTOM: #82b2c7 1px solid; HEIGHT: 19px; BACKGROUND-COLOR: #ffffff
}
.STYLE1 {color: #126191}
</STYLE>

<META content="MSHTML 6.00.6000.17095" name=GENERATOR></HEAD>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width=700 align=center border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE height=500 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <form id="adminloginform" name="adminloginform" method="post" action="?action=checklogin">
              <TBODY>
              <TR>
                
                <TD width=357>
                  <TABLE 
                  style="BORDER-RIGHT: #cce4f0 1px solid; BORDER-TOP: #cce4f0 1px solid; BACKGROUND: #f6fbff; BORDER-LEFT: #cce4f0 1px solid; BORDER-BOTTOM: #cce4f0 1px solid; TEXT-ALIGN: center" 
                  height=160 cellSpacing=0 cellPadding=0 width=300 
                    align=center><TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                          <TBODY>
                          <TR>
                            <TD height=30>用户名:&nbsp;&nbsp;&nbsp; <input style="BACKGROUND-POSITION: 1px 1px; PADDING-LEFT: 20px; BACKGROUND-IMAGE: url(images/username.gif); BACKGROUND-REPEAT: no-repeat" name="adminname" type="text" class="input" /></TD></TR>
                          <TR>
                            <TD 
                              height=30>密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;&nbsp; 
                              <input style="BACKGROUND-POSITION: 1px 1px; PADDING-LEFT: 20px; BACKGROUND-IMAGE: url(images/password.gif); BACKGROUND-REPEAT: no-repeat" name="password" type="password" class="input" PADDING-LEFT: 20px; BACKGROUND-IMAGE: url(images/password.gif); BACKGROUND-REPEAT: no-repeat/></TD></TR>
                          <TR>
                            <TD height=30><SPAN 
                              style="FLOAT: left; MARGIN-LEFT: 48px">验证码:&nbsp;&nbsp;&nbsp; 
                              <input name="entered_imagecode" type="text" id="entered_imagecode" size="6" maxlength="4"></SPAN><img src="../include/vdimgck.php" align="absmiddle"></TD></TR>
                          <TR>
                        <TD height=30><INPUT id=Su style="BORDER-TOP-WIDTH: 0px; PADDING-RIGHT: 15px; PADDING-LEFT: 15px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: #40b6f6; BORDER-BOTTOM-WIDTH: 0px; PADDING-BOTTOM: 0px; OVERFLOW: visible; CURSOR: pointer; COLOR: #fff; PADDING-TOP: 0px; HEIGHT: 1.8em; BORDER-RIGHT-WIDTH: 0px" type=submit value="登  录" name=Submit></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                <TD width=2 
        bgColor=#ffffff></TD>
              </TR></FORM></TABLE></TD></TR></TABLE></TD></TR>
  <TR>
    <TD align=middle height=33>
      <HR color=#cce4ee>
      <FONT 
      style="FONT-SIZE: 10px; FONT-FAMILY: Arial, Helvetica, sans-serif">Powered 
      by <STRONG><a href="../">NaErCe</a></STRONG> Network&copy; 2010-2011<span class="STYLE1"><a href="http://www.1230530.com/"></a></span></FONT></TD>
  </TR></TBODY></TABLE>	  <script language="javascript">
if (top.location != location) top.location.href = location.href;
self.moveTo(0,0);
self.resizeTo(screen.availWidth,screen.availHeight);
adminloginform.adminname.focus();
</script></BODY></HTML>
'
?>
