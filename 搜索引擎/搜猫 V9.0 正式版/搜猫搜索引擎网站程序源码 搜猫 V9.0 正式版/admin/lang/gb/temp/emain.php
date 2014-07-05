<?php

if(!defined('InEmpireBak'))
{
exit();
}
if (function_exists('ini_get')){
$onoff = ini_get('register_globals');
}else {
$onoff = get_cfg_var('register_globals');
}
if ($onoff){
$onoff='打开';
}else{
$onoff='关闭';
}
if (function_exists('ini_get')){
$upload = ini_get('file_uploads');
}else {
$upload = get_cfg_var('file_uploads');
}
if ($upload){
$upload='可以';
}else{
$upload='不可以';
}
function GetUseSys()
{
$phpos=explode(' ',php_uname());
$sys=$phpos[0].'&nbsp;'.$phpos[1];
if(empty($phpos[0]))
{
$sys='---';
}
return $sys;
}
function GetPhpSafemod()
{
$phpsafemod=get_cfg_var('safe_mode');
if($phpsafemod==1)
{
$word='PHP运行于安全模式';
}
else
{
$word='正常模式';
}
return $word;
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>帝国备份王</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">我的状态</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="25"> <div align="left">登录者:&nbsp;<b> 
                    ';echo $loginin;echo '                    </b></div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>
        <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            
          <td height="38" bgcolor="#FFFFFF">
<div align="center"><a href="http://www.phome.net/ecms6/" target="_blank"><strong><font color="#0000FF" size="3">帝国网站管理系统全面开源 
              － 最安全、最稳定的开源CMS系统</font></strong></a></div></td>
          </tr>
        </table>
      </td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">帝国备份王版权声名</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td><strong>如果您想使用本系统(即：帝国备份王)，请详细阅读以下条款，只有在接受了以下条款的情况下您才可以使用本系统：</strong></td>
              </tr>
              <tr> 
                <td>1、本程序为免费代码,提供个人网站免费使用，请勿非法修改、转载、散播、或用于其他图利行为，并请勿删除版权声明。</td>
              </tr>
              <tr> 
                <td>2、本程序为免费代码,用户自由选择是否使用，在使用中出现任何问题而造成的损失<strong><a href="http://www.phome.net" target="_blank">帝国软件</a></strong>不负任何责任。 
                </td>
              </tr>
              <tr> 
                <td>3、本程序不允许在没有事先通知的情况下用于商业用途，假如您需要用于商业用途，请和<a href="http://www.phome.net" target="_blank"><u>我们联系</u></a>，以获得商业使用权。 
                </td>
              </tr>
              <tr> 
                <td>4、如果违反以上条款，<strong><a href="http://www.phome.net" target="_blank">帝国软件</a></strong>对此保留一切法律追究的权利。</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><a href="phpinfo.php" target="_blank"></a></strong> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" height="16"><strong><a href="phpinfo.php" target="_blank"><font color="#FFFFFF">系统信息</font></a></strong></td>
                <td><div align="right"><strong><a href="http://www.dotool.cn" target="_blank"><font color="#FFFFFF">站长工具</font></a></strong></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="26">服务器软件: 
                  ';echo $_SERVER['SERVER_SOFTWARE'];echo '                </td>
                <td height="26">操作系统&nbsp;&nbsp;:
				';echo GetUseSys();;echo '</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">PHP版本&nbsp;&nbsp; : ';echo PHP_VERSION;;echo '</td>
                <td height="25">MYSQL版本&nbsp;:
				';echo @mysql_get_server_info();;echo '</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">全局变量&nbsp;&nbsp;: 
                  ';echo $onoff;echo '                </td>
                <td height="25">上传文件&nbsp;&nbsp;: 
                  ';echo $upload;echo '                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">登录者IP&nbsp;&nbsp;:
				';echo $_SERVER['REMOTE_ADDR'];;echo '</td>
                <td height="25">当前时间&nbsp;&nbsp;:
				';echo date('Y-m-d H:i:s');;echo '</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">程序版本&nbsp;&nbsp;: <a href="http://www.phome.net" target="_blank"><strong><font color="#07519A">EmpireBak</font></strong> 
                  <font color="#FF9900"><strong>v2010</strong></font></a> <font color="#666666">[开源版]</font></td>
                <td height="25">安全模式&nbsp;&nbsp;: 
                  ';echo GetPhpSafemod();echo '                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25" colspan="2"><strong><font color="#FFFFFF">程序其它相关信息</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">官方主页: <a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">官方论坛: <a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">公司网站：<a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">帝国产品：<a href="http://www.phome.net/product" target="_blank">http://www.phome.net/product</a></td>
              </tr>
            </table></td>
          <td width="60%" height="125" valign="top" bgcolor="#FFFFFF">
<IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="32" valign="bottom"> 
      <div align="center">Powered by <a href="http://www.phome.net" target="_blank"><strong><font color="#07519A">EmpireBak</font></strong> 
        <font color="#FF9900"><strong>v2010</strong></font></a></div></td>
  </tr>
</table>
</body>
</html>';
?>