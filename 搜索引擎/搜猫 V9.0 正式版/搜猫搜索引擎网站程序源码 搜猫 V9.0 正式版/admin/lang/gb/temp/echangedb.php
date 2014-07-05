<?php

if(!defined('InEmpireBak'))
{
exit();
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>选择数据库</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{
	var ok;
	ok=confirm("确认要删除此数据库?");
	if(ok)
	{
		self.location.href=\'phome.php?phome=DropDb&mydbname=\'+dbname;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：备份数据 -&gt; <a href="ChangeDb.php">选择数据库</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">备份步骤：<font color="#FF0000">选择数据库</font> 
        -&gt; 选择要备份的表 -&gt; 开始备份 -&gt; 完成</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr bgcolor="#0472BC"> 
    <td width="56%" height="25" bgcolor="#0472BC"> 
      <div align="center"><strong><font color="#FFFFFF">数据库名</font></strong></div></td>
    <td width="44%" height="25"> 
      <div align="center"><strong><font color="#FFFFFF">备份</font></strong></div></td>
  </tr>
  ';
$i=0;
while($r=$empire->fetch($sql))
{
$i++;
if($i%2==0)
{
$bgcolor='#DBEAF5';
}
else
{
$bgcolor='#ffffff';
}
;echo '  <tr bgcolor="';echo $bgcolor;echo '"> 
    <td height="25"> 
      <div align="center">';echo $r[0];echo '</div></td>
    <td height="25"> 
      <div align="center"> 
        <input type="button" name="Submit" value="备份数据" onclick="self.location.href=\'ChangeTable.php?mydbname=';echo $r[0];echo '\';">
        &nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="执行SQL" onclick="self.location.href=\'DoSql.php?mydbname=';echo $r[0];echo '\';">
		&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="删除数据库" onclick="javascript:DoDrop(\'';echo $r[0];echo '\')">
      </div></td>
  </tr>
  ';
}
;echo '  <tr> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            <td height="25"><strong><font color="#FFFFFF">建立数据库
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </font></strong></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">数据库名： 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">默认编码</option>
                ';
echo Ebak_ReturnDbCharList('');
;echo '              </select>
              <input type="submit" name="Submit2" value="建立">
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>';
?>