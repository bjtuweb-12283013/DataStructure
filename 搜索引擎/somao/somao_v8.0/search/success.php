<?php
require "../global.php";
?><html>
<head>
<meta content="text/html; charset=GB2312" http-equiv="content-type">
<title><?php echo $config["name"];?>搜索指南_网站登录</title>
<link href="help.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function h(obj,url){
obj.style.behavior='url(#default#homepage)';
obj.setHomePage(url);
}
-->
</script>
</head>
<body bgcolor=#ffffff text=#000000 vlink=#0033CC alink=#800080  link=#0033cc topmargin="0">
<a name="n"></a>
<table width="95%" border=0 align="center">
  <tr height=60> 
      
    <td width=139 valign="top" height="69"><a href="<?php echo $config["url"];?>"><img src="../images/logo.gif" width="137" height="46" border="0"></a></td>
      
    <td valign="bottom"> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#e5ecf9"> 
          <td height="24">&nbsp;<b class="p1">网站登录</b></td>
          <td height="24" class="p2"> 
            <div align="right"> &nbsp;</div>
          </td>
        </tr>
        <tr> 
          <td height="20" class="p2" colspan="2"></td>
        </tr>
      </table>
    </td>
  </tr>

</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td height="5" colspan="3"></td>
  </tr>

</table>
<b class="p1"><a name="n1"></a></b>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#e5ecf9" width="750">&nbsp;<b class="p1">网站登录</b></td>
        </tr>
        <tr> 
          <td class="padd10"><table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><br>
        <p align="center"><font color="#FF0000"><strong>提交成功！</strong></font><strong><font color="#FF0000">感谢您对<?php echo $config["name"];?>的关注和支持！</font></strong></p>
        <p align="center"><br>
        </p>
        <p align="center">
          <input name="Submit" type="submit" value="返  回"
                onClick="window.location='<?php echo $config["url"];?>/search/url_submit.php';">
        </p>
      </div></td>
    </tr>
  </table> 
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<br>
<hr size="1" color="#dddddd" width="95%">

<table width="95%" border=0 align="center">
<TR>
    <TD class=p1 align=middle><FONT color=#666666>&copy; 2009 Qiaso</FONT> <A href="<?php echo $config["url"];?>/duty/index.html" target="_blank"><FONT color=#666666>免责声明</FONT></A></TD>
</TR>
</table>
</body></html>