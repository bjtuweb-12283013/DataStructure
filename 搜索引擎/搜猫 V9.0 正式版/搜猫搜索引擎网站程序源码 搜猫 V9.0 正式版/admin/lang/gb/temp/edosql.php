<?php

if(!defined('InEmpireBak'))
{
exit();
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>执行SQL语句</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：执行SQL语句</td>
  </tr>
</table>

<form action="phome.php" method="POST" name="form1" onsubmit="return confirm(\'确认要执行？\');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><div align="center"><strong><font color="#FFFFFF">执行SQL语句</font></strong></div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <table width="560" border="0" cellpadding="3" cellspacing="1">
            <tr>
              <td width="50%">数据库： 
                <select name="mydbname" id="mydbname">
				<option value=""></option>
				';
echo $db;
;echo '                </select>
              </td>
              <td><div align="right">数据编码： 
                  <input name="mydbchar" type="text" id="mydbchar" value="';echo $phome_db_char;echo '" size="16">
                  <font color="#666666"> 
                  <select name="selectchar" onchange="document.form1.mydbchar.value=this.value">
                    <option value="">选择</option>
                    ';
echo $chars;
;echo '                  </select>
                  </font></div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <textarea name="query" cols="90" rows="12" id="query"></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <input type="submit" name="Submit" value=" 执行SQL">
          &nbsp;&nbsp; 
          <input type="reset" name="Submit2" value="重置">
          <input name="phome" type="hidden" id="phome" value="DoExecSql">
        </div></td>
    </tr>
  </table>
  </form>
  <br>
<form action="phome.php" method="post" enctype="multipart/form-data" name="form2" onsubmit="return confirm(\'确认要导入？\');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><div align="center"><strong><font color="#FFFFFF">导入SQL文件</font></strong></div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <table width="560" border="0" cellpadding="3" cellspacing="1">
            <tr> 
              <td width="50%">数据库： 
                <select name="mydbname" id="mydbname">
                  <option value=""></option>
                  ';
echo $db;
;echo '                </select> </td>
              <td><div align="right">数据编码： 
                  <input name="mydbchar" type="text" id="mydbchar" value="';echo $phome_db_char;echo '" size="16">
                  <font color="#666666"> 
                  <select name="selectchar" onchange="document.form2.mydbchar.value=this.value">
                    <option value="">选择</option>
                    ';
echo $chars;
;echo '                  </select>
                  </font></div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">
          <table width="560" border="0" cellspacing="1" cellpadding="3">
            <tr>
              <td>SQL文件：
                <input name="file" type="file" size="38">
                <font color="#666666">(*.sql，最大文件：';echo @get_cfg_var('file_uploads')?@get_cfg_var('upload_max_filesize'):'不允许上传';;echo ')</font> 
              </td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <input type="submit" name="Submit3" value="导入SQL">
          &nbsp;&nbsp; 
          <input type="reset" name="Submit22" value="重置">
          <input name="phome" type="hidden" id="phome" value="DoTranExecSql">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>';
?>