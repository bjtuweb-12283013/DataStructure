<?php
require "../global.php";
?>
<html>
<head>
<meta content="text/html; charset=GB2312" http-equiv="content-type">
<title><?php echo $config["name"];?>搜索帮助中心-免费代码</title>
<link href="help.css" rel="stylesheet" type="text/css">
<link href="iknow.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function h(obj,url){
obj.style.behavior='url(#default#homepage)';
obj.setHomePage(url);
}
-->
</script>
<style type="text/css">
<!--
.p1,td {FONT-SIZE: 14px; LINE-HEIGHT: 24px; FONT-FAMILY: "宋体"}
.p2 { FONT-SIZE: 14px; LINE-HEIGHT: 24px; color: #333333}
.p3 { FONT-SIZE: 14px; LINE-HEIGHT: 24px; color: #0033cc}
.p4 { font-size: 14px;  LINE-HEIGHT: 24px; color: #0033cc }
.padd10{padding-left:10px;}
.f12 {	FONT-SIZE: 13px; LINE-HEIGHT: 20px}
.Lbg{margin:13px 0 7px 0;height:1px;line-height:1px;border-top:1px solid #999999}
.f14B{font-size:14px;line-height:22px;font-weight:bold;}
.org,a.org:link,a.org:visited{color:#ff6600}
.box{padding:20px;font-size:14px}
-->
</style>
</head>
<body bgcolor=#ffffff text=#000000 vlink=#0033CC alink=#800080  link=#0033cc topmargin="0">
<a name="n"></a>
<table width="95%" border=0 align="center">
  <tr height=60>

    <td width=139 valign="top" height="69"><a href="<?php echo $config["url"];?>"><img src="<?php echo $config["url"];?>/images/logo.gif" border="0"></a></td>

    <td valign="bottom">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#e5ecf9">
          <td height="24">&nbsp;<b class="p1">免费代码</b></td>
          <td height="24" class="p2">
            <div align="right"><a  href="jiqiao.html"><span style="font-size:14px;"><font color="#0033cc">帮助中心</font></span></a> &nbsp;</div>
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
  <tr>
    <td height="19" colspan="3" class="padd10"><a href="#1" class="p3"><b><font color="#0033cc">免费搜索代码</font></b></a>　</td>
  </tr>
</table>
<b class="p1"><a name="1"></a></b><br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#e5ecf9" width="750">&nbsp;<b class="p1">免费搜索代码</b></td>
                    </tr>
                  </table>
                  <div align="right"></div></td>
              </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="750"><br> <TABLE cellSpacing=0 cellPadding=0 width="99%" border=0>
                          <TR>
                            <TD> <table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
                                <tr>
                                  <td class="p2"> ·<?php echo $config["name"];?>向网友开放免费下载<?php echo $config["name"];?>搜索代码。<br>
                                    ·只需将以下代码之一加入到您的网页中，您的网站即可获得同<?php echo $config["name"];?>搜索引擎一样强大的搜索功能！<br></td>
                                </tr>
                              </table>
                              <BR> <TABLE cellSpacing=0 cellPadding=0 width=90% align=center border=0>
                                <TR>
                                  <TD> <FORM name=query action=<?php echo $config["url"];?>/s/ method=get target=_blank>
                                      <A href="<?php echo $config["url"];?>/"><IMG
                        src="<?php echo $config["url"];?>/images/logo-80px.gif" alt=ZeiGou border=0
                        align=bottom></A>
                                      <INPUT size=30 name=wd>
                                      <INPUT name="submit" type=submit value=<?php echo $config["name"];?>一下>
                                    </FORM>
									</TD>
                                </TR>
                                <TR>
                                  <TD vAlign=top><span class="style2">HTML代码：</span><BR>
                                    <TEXTAREA name=textarea rows=6 cols=60>&lt;form action="<?php echo $config['url'];?>/s/" target="_blank"&gt;
&lt;table bgcolor="#FFFFFF"&gt;&lt;tr&gt;&lt;td&gt;
&lt;a href="<?php echo $config["url"];?>/"&gt;&lt;img src="<?php echo $config["url"];?>/images/logo-80px.gif" alt="ZeiGou" align="bottom" border="0"&gt;&lt;/a&gt;
&lt;input type=text name=wd size=30&gt;
&lt;input type="submit" value="<?php echo $config["name"];?>搜索"&gt;
&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;
&lt;/form&gt;</TEXTAREA>
                                  </TD>
                                </TR>
                              </TABLE>
                              <br><div class="Lbg" id="Lbg">&nbsp;</div>
                              <br>
                            　                            </TD>
                          </TR>
                        </TABLE></td>
                    </tr>
      </table>            <br>      <br></td>
  </tr>
</table>

<hr size="1" color="#dddddd" width="95%">

<table width="95%" border=0 align="center">
  <tr>
    <td align=center class=p1> <font color="#666666">&copy; 2009 Feimao</font>
      <a href=<?php echo $config["url"];?>/duty/index.html ><font color="#666666">免责声明</font></a></td>
  </tr>
</table>
</body></html>