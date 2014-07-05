<?php

if(!defined('InEmpireBak'))
{
exit();
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>参数设置</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function ChangeSet(cset){
	if(cset=="setuser")
	{
		setdb.style.display="none";
		setuser.style.display="";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="none";
	}
	else if(cset=="setck")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="";
		//setlang.style.display="none";
		setother.style.display="none";
	}
	else if(cset=="setlang")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="";
		setother.style.display="none";
	}
	else if(cset=="setother")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="";
	}
	else
	{
		setdb.style.display="";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="none";
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="SetDb.php">参数设置</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr bgcolor="#FFFFFF"> 
    <td width="20%" height="23" id="dbtd" onmouseover="this.style.backgroundColor=\'#DBEAF5\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet(\'setdb\');">数据库设置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor=\'#DBEAF5\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet(\'setuser\');">帐号设置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor=\'#DBEAF5\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet(\'setck\');">COOKIE设置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor=\'#DBEAF5\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet(\'setother\');">其它设置</a></strong></div></td>
  </tr>
</table>
<form name="form1" method="post" action="phome.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setdb">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>数据库设置 
        <input name="phome" type="hidden" id="phome" value="SetDb">
        </strong></font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>MYSQL版本</strong></td>
      <td height="25" bgcolor="#FFFFFF"><p> 
          <input type="radio" name="mysqlver" value="5.0"';echo $phome_db_ver=='5.0'?' checked':'';echo '>
          MYSQL5.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.1"';echo $phome_db_ver=='4.1'?' checked':'';echo '>
          MYSQL 4.1.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.0"';echo $phome_db_ver=='4.0'?' checked':'';echo '>
          MYSQL 4.0.*/3.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="auto"';echo $phome_db_ver==''?' checked':'';echo '>
          自动选择</p></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF"><strong>数据库服务器</strong></td>
      <td width="76%" height="25" bgcolor="#FFFFFF"><input name="dbhost" type="text" id="dbhost" value="';echo $phome_db_server;echo '"> 
        <font color="#666666">(比如：localhost)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">数据库服务器端口</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbport" type="text" id="dbport" value="';echo $phome_db_port;echo '"> 
        <font color="#666666">(一般情况下为空即可)</font> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>数据库用户名</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbusername" type="text" id="dbusername" value="';echo $phome_db_username;echo '"> 
        <font color="#666666">(比如：root)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>数据库密码</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbpassword" type="password" id="dbpassword">
        (<font color="#FF0000">不想修改请留空。无密码用“null”表示</font>)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默认备份的数据库</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbname" type="text" id="dbname" value="';echo $phome_db_dbname;echo '"> 
        <font color="#666666">(可为空,如输入数据库名,备份直接转到这个库.) </font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">默认备份数据表的前缀</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbaktbpre" type="text" id="sbaktbpre" value="';echo $baktbpre;echo '">
        <font color="#666666">(空为列出所有数据表.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默认编码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbchar" type="text" id="dbchar" value="';echo $phome_db_char;echo '"> 
        <font color="#666666"> 
        <select name="selectchar" onchange="document.form1.dbchar.value=this.value">
          <option value="">选择</option>
          ';
echo Ebak_ReturnDbCharList('');
;echo '        </select>
        (一般情况下为空即可) </font></td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setuser" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">帐号设置</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">用户名</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminusername" type="text" id="adminusername" value="';echo $set_username;echo '">
        <font color="#666666">(修改后要重新登录)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">密码</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminpassword" type="password" id="adminpassword"> 
        <font color="#666666">(不想修改请留空)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">认证码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginauth" type="text" id="adminloginauth" value="';echo $set_loginauth;echo '">
        <font color="#666666">(二级密码,空为不设置)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">验证随机码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginrnd" type="text" id="adminloginrnd" value="';echo $set_loginrnd;echo '">
        <font color="#666666">
        <input type="button" name="Submit3" value="随机" onclick="document.form1.adminloginrnd.value=\'';echo $loginauthrnd;echo '\';">
        (修改后要重新登录)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">超时限制</td>
      <td height="25" bgcolor="#FFFFFF"><input name="outtime" type="text" id="outtime" value="';echo $set_outtime;echo '">
        分钟</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">登录是否需要验证码</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginkey" value="0"';echo $set_loginkey==0?' checked':'';echo '>
        是 
        <input type="radio" name="loginkey" value="1"';echo $set_loginkey==1?' checked':'';echo '>
        否</td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setck" style="display:none">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>COOKIE设置(通常不需要修改)</strong></font></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">COOKIE作用域</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckdomain" type="text" id="ckdomain" value="';echo $phome_cookiedomain;echo '"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE作用路径</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckpath" type="text" id="ckpath" value="';echo $phome_cookiepath;echo '"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE变量前缀</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckvarpre" type="text" id="ckvarpre" value="';echo $phome_cookievarpre;echo '"></td>
    </tr>
	</table>
	
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setother" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">其它设置</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">数据备份目录</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakpath" type="text" id="sbakpath" value="';echo $bakpath;echo '"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">压缩包存放目录</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakzippath" type="text" id="sbakzippath" value="';echo $bakzippath;echo '"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件生成权限设置</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="sfilechmod" value="0"';echo $filechmod0;echo '>
        0777 
        <input type="radio" name="sfilechmod" value="1"';echo $filechmod1;echo '>
        不限制<font color="#666666">(如果空间不支持运行0777的.php文件,选择不限制即可.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP运行于安全模式</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphpsafemod" type="checkbox" id="sphpsafemod" value="1"';echo $phpsafemod==1?' checked':'';echo '>
        是<font color="#666666">(如果运行于安全模式，所有数据均备份到bdata/safemod目录)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP超时时间设置</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphp_outtime" type="text" id="sphp_outtime" value="';echo $php_outtime;echo '" size="6">
        秒 <font color="#666666">(一般不需要设置，需要set_time_limit()支持才有效)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF"> <p>MYSQL支持查询方式</p></td>
      <td height="25" bgcolor="#FFFFFF"><input name="slimittype" type="checkbox" id="slimittype" value="1"';echo $checklimittype;echo '>
        支持 <font color="#666666">(如果备份时出现下面错误,请将打勾去掉即可解决)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><font color="#FF0000">You have an error 
        in your SQL syntax; check the manual that corresponds to your MySQL server 
        version for the right syntax to use near \'-1\' at line 1</font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">空间不支持数据库列表</td>
      <td height="25" bgcolor="#FFFFFF"><input name="scanlistdb" type="checkbox" id="scanlistdb" value="1"';echo $canlistdb==1?' checked':'';echo '>
        不支持<font color="#666666">(如果空间不允许列出数据库,请打勾；并且要设置默认备份的数据库)</font></td>
    </tr>
  </table>
	<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <div align="left"> 
          <input type="submit" name="Submit" value="提交">&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>'
?>