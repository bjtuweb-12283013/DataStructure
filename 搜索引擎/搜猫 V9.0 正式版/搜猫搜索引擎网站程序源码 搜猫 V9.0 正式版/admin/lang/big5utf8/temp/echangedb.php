<?php

if(!defined('InEmpireBak'))
{
exit();
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>選擇數據庫</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{
	var ok;
	ok=confirm("確認要刪除此數據庫?");
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
    <td>位置：備份數據 -&gt; <a href="ChangeDb.php">選擇數據庫</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">備份步驟：<font color="#FF0000">選擇數據庫</font> 
        -&gt; 選擇要備份的表 -&gt; 開始備份 -&gt; 完成</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr bgcolor="#0472BC"> 
    <td width="56%" height="25" bgcolor="#0472BC"> 
      <div align="center"><strong><font color="#FFFFFF">數據庫名</font></strong></div></td>
    <td width="44%" height="25"> 
      <div align="center"><strong><font color="#FFFFFF">備份</font></strong></div></td>
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
        <input type="button" name="Submit" value="備份數據" onclick="self.location.href=\'ChangeTable.php?mydbname=';echo $r[0];echo '\';">
        &nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="執行SQL" onclick="self.location.href=\'DoSql.php?mydbname=';echo $r[0];echo '\';">
		&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="刪除數據庫" onclick="javascript:DoDrop(\'';echo $r[0];echo '\')">
      </div></td>
  </tr>
  ';
}
;echo '  <tr> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            <td height="25"><strong><font color="#FFFFFF">建立數據庫
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </font></strong></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">數據庫名： 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">默認編碼</option>
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