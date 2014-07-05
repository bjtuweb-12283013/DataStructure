<?php

if(!defined('InEmpireBak'))
{
exit();
}
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>选择数据表</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name==\'bakstru\'||e.name==\'bakstrufour\'||e.name==\'beover\'||e.name==\'autoauf\'||e.name==\'baktype\'||e.name==\'bakdatatype\')
		{
		continue;
	    }
	if (e.name != \'chkall\')
       e.checked = form.chkall.checked;
    }
  }
function reverseCheckAll(form)
{
  for (var i=0;i<form.elements.length;i++)
  {
    var e = form.elements[i];
    if(e.name==\'bakstru\'||e.name==\'bakstrufour\'||e.name==\'beover\'||e.name==\'autoauf\'||e.name==\'baktype\'||e.name==\'bakdatatype\')
	{
		continue;
	}
	if (e.name != \'chkall\')
	{
	   if(e.checked==true)
	   {
       		e.checked = false;
	   }
	   else
	   {
	  		e.checked = true;
	   }
	}
  }
}
function SelectCheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name==\'bakstru\'||e.name==\'bakstrufour\'||e.name==\'beover\'||e.name==\'autoauf\'||e.name==\'baktype\'||e.name==\'bakdatatype\')
		{
		continue;
	    }
	if (e.name != \'chkall\')
	  	e.checked = true;
    }
  }
function check()
{
	var ok;
	ok=confirm("确认要执行此操作?");
	return ok;
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="51%">位置：备份数据 -&gt; <a href="ChangeDb.php">选择数据库</a>(<b>';echo $mydbname;echo '</b>) -&gt; <a href="ChangeTable.php?mydbname=';echo $mydbname;echo '">选择备份表</a></td>
    <td width="49%"><div align="right"> </div></td>
  </tr>
  <tr> 
    <td height="25" colspan="2"><div align="center">备份步骤：选择数据库 -&gt; <font color="#FF0000">选择要备份的表</font> 
        -&gt; 开始备份 -&gt; 完成</div></td>
  </tr>
</table>
<form name="ebakchangetb" method="post" action="phomebak.php" onsubmit="return check();">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><font color="#FFFFFF">备份参数设置： 
        <input name="phome" type="hidden" id="phome" value="DoEbak">
        <input name="mydbname" type="hidden" id="mydbname" value="';echo $mydbname;echo '">
        </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="22%">&nbsp;</td>
            <td> [<a href="#ebak" onclick="javascript:window.open(\'ListSetbak.php?mydbname=';echo $mydbname;echo '&change=1\',\'\',\'width=550,height=380,scrollbars=yes\');">导入设置</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showsave.style.display=\'\';">保存设置</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showreptable.style.display=\'\';">批量替换表名</a>]</td>
          </tr>
          <tr id="showsave" style="display:none">
            <td>&nbsp;</td>
            <td>保存文件名:setsave/ 
              <input name="savename" type="text" id="savename" value="';echo $_GET['savefilename'];echo '">
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value=\'DoSave\';document.ebakchangetb.action=\'phome.php\';" value="保存设置">
              <font color="#666666">(文件名请用英文字母,如：test)</font></td>
          </tr>
		  <tr id="showreptable" style="display:none">
            <td>&nbsp;</td>
            <td> 原字符: 
              <input name="oldtablepre" type="text" id="oldtablepre" size="18">
              新字符:
              <input name="newtablepre" type="text" id="newtablepre" size="18"> 
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value=\'ReplaceTable\';document.ebakchangetb.action=\'phome.php\';" value="替换选中表名">
            </td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="22%"><input type="radio" name="baktype" value="0"';echo $dbaktype==0?' checked':'';echo '> 
              <strong>按文件大小备份</strong> </td>
            <td width="78%" height="23"> 每组备份大小: 
              <input name="filesize" type="text" id="filesize" value="';echo $dfilesize;echo '" size="6">
              KB <font color="#666666">(1 MB = 1024 KB)</font></td>
          </tr>
          <tr> 
            <td><input type="radio" name="baktype" value="1"';echo $dbaktype==1?' checked':'';echo '> 
              <strong>按记录数备份</strong></td>
            <td height="23">每组备份 
              <input name="bakline" type="text" id="bakline" value="';echo $dbakline;echo '" size="6">
              条记录， 
              <input name="autoauf" type="checkbox" id="autoauf" value="1"';echo $dautoauf==1?' checked':'';echo '>
              自动识别自增字段<font color="#666666">(此方式效率更高)</font></td>
          </tr>
          <tr> 
            <td>备份数据库结构</td>
            <td height="23"><input name="bakstru" type="checkbox" id="bakstru" value="1"';echo $dbakstru==1?' checked':'';echo '>
              是 <font color="#666666">(没特殊情况，请选择)</font></td>
          </tr>
          <tr> 
            <td>数据编码</td>
            <td height="23"> <select name="dbchar" id="dbchar">
                <option value="auto"';echo $ddbchar=='auto'?' selected':'';echo '>自动识别编码</option>
                <option value=""';echo $ddbchar==''?' selected':'';echo '>不设置</option>
                ';
echo Ebak_ReturnDbCharList($ddbchar);
;echo '              </select> <font color="#666666">(从mysql4.0导入mysql4.1以上版本需要选择固定编码，不能选自动)</font></td>
          </tr>
          <tr>
            <td>数据存放格式</td>
            <td height="23"><input type="radio" name="bakdatatype" value="0"';echo $dbakdatatype==0?' checked':'';echo '>
              正常
              <input type="radio" name="bakdatatype" value="1"';echo $dbakdatatype==1?' checked':'';echo '>
              十六进制方式<font color="#666666">(十六进制备份文件会占用更多的空间)</font></td>
          </tr>
          <tr> 
            <td>存放目录</td>
            <td height="23"> 
              ';echo $bakpath;echo '              / 
              <input name="mypath" type="text" id="mypath" value="';echo $mypath;echo '" size="28"> 
              <font color="#666666"> 
              <input type="button" name="Submit2" value="选择目录" onclick="javascript:window.open(\'ChangePath.php?change=1&toform=ebakchangetb\',\'\',\'width=750,height=500,scrollbars=yes\');">
              (目录不存在，系统会自动建立)</font></td>
          </tr>
          <tr> 
            <td>备份选项</td>
            <td height="23">导入方式: 
              <select name="insertf" id="select">
                <option value="replace"';echo $dinsertf=='replace'?' selected':'';echo '>REPLACE</option>
                <option value="insert"';echo $dinsertf=='insert'?' selected':'';echo '>INSERT</option>
              </select>
              , 
              <input name="beover" type="checkbox" id="beover" value="1"';echo $dbeover==1?' checked':'';echo '>
              完整插入，
              <input name="bakstrufour" type="checkbox" id="bakstrufour" value="1"';echo $dbakstrufour==1?' checked':'';echo '>
              <a title="需要转换数据表编码时选择">转成MYSQL4.0格式</a>, 每组备份间隔： 
              <input name="waitbaktime" type="text" id="waitbaktime" value="';echo $dwaitbaktime;echo '" size="2">
              秒</td>
          </tr>
          <tr> 
            <td valign="top">备份说明<br> <font color="#666666">(系统会生成一个readme.txt)</font></td>
            <td height="23"><textarea name="readme" cols="80" rows="5" id="readme">';echo $dreadme;echo '</textarea></td>
          </tr>
          <tr> 
            <td valign="top">去除自增值的字段列表：<br> <font color="#666666">(格式：<strong>表名.字段名</strong><br>
              多个请用&quot;,&quot;格开)</font></td>
            <td height="23"><textarea name="autofield" cols="80" rows="5" id="autofield">';echo $dautofield;echo '</textarea></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="25">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%"><font color="#FFFFFF">选择要备份的表：( <a href="#ebak" onclick="SelectCheckAll(document.ebakchangetb)"><font color="#ffffff"><u>全选</u></font></a> 
              | <a href="#ebak" onclick="reverseCheckAll(document.ebakchangetb);"><font color="#ffffff"><u>反选</u></font></a> )</font></td>
            <td><div align="right"><font color="#FFFFFF">查询:</font> 
                <input name="keyboard" type="text" id="keyboard" value="';echo $keyboard;echo '">
                <input type="button" name="Submit32" value="显示数据表" onclick="self.location.href=\'ChangeTable.php?sear=1&mydbname=';echo $mydbname;echo '&keyboard=\'+document.ebakchangetb.keyboard.value;">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr bgcolor="#DBEAF5"> 
            <td width="5%" height="23"> <div align="center">选择</div></td>
            <td width="27%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">表名(点击查看字段)</div></td>
            <td width="13%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">类型</div></td>
            <td width="15%" bgcolor="#DBEAF5">
<div align="center">编码</div></td>
            <td width="15%" height="23"> 
              <div align="center">记录数</div></td>
            <td width="14%" height="23"> 
              <div align="center">大小</div></td>
            <td width="11%" height="23"> 
              <div align="center">碎片</div></td>
          </tr>
          ';
$tbchecked=' checked';
if($dtblist)
{
$check=1;
}
$totaldatasize=0;
$tablenum=0;
$datasize=0;
$rownum=0;
while($r=$empire->fetch($sql))
{
$rownum+=$r[Rows];
$tablenum++;
$datasize=$r[Data_length]+$r[Index_length];
$totaldatasize+=$r[Data_length]+$r[Index_length]+$r[Data_free];
if($check==1)
{
if(strstr($dtblist,','.$r[Name].','))
{
$tbchecked=' checked';
}
else
{
$tbchecked='';
}
}
$collation=$r[Collation]?$r[Collation]:'---';
;echo '          <tr id=tb';echo $r[Name];echo '> 
            <td height="23"> <div align="center"> 
                <input name="tablename[]" type="checkbox" id="tablename[]" value="';echo $r[Name];echo '" onclick="if(this.checked){tb';echo $r[Name];echo '.style.backgroundColor=\'#F1F7FC\';}else{tb';echo $r[Name];echo '.style.backgroundColor=\'#ffffff\';}"';echo $tbchecked;echo '>
              </div></td>
            <td height="23"> <div align="left"><a href="#ebak" onclick="window.open(\'ListField.php?mydbname=';echo $mydbname;echo '&mytbname=';echo $r[Name];echo '\',\'\',\'width=660,height=500,scrollbars=yes\');" title="点击查看表字段列表"> 
                ';echo $r[Name];echo '                </a></div></td>
            <td height="23"> <div align="center">
                ';echo $r[Type]?$r[Type]:$r[Engine];echo '              </div></td>
            <td><div align="center">
				';echo $collation;echo '              </div></td>
            <td height="23"> <div align="right">
                ';echo $r[Rows];echo '              </div></td>
            <td height="23"> <div align="right">
                ';echo Ebak_ChangeSize($datasize);echo '              </div></td>
            <td height="23"> <div align="right">
                ';echo Ebak_ChangeSize($r[Data_free]);echo '              </div></td>
          </tr>
          ';
}
;echo '          <tr bgcolor="#DBEAF5"> 
            <td height="23"> <div align="center">
                <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)"';echo $check==0?' checked':'';echo '>
              </div></td>
            <td height="23"> <div align="center"> 
                ';echo $tablenum;echo '              </div></td>
            <td height="23"> <div align="center">---</div></td>
            <td><div align="center">---</div></td>
            <td height="23"> <div align="center">
                ';echo $rownum;echo '              </div></td>
            <td height="23" colspan="2"> <div align="center">
                ';echo Ebak_ChangeSize($totaldatasize);echo '              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25">
<div align="center">
          <input type="submit" name="Submit" value="开始备份" onclick="document.ebakchangetb.phome.value=\'DoEbak\';document.ebakchangetb.action=\'phomebak.php\';">
          &nbsp;&nbsp; &nbsp;&nbsp;
          <input type="submit" name="Submit2" value="修复数据表" onclick="document.ebakchangetb.phome.value=\'DoRep\';document.ebakchangetb.action=\'phome.php\';">
          &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="优化数据表" onclick="document.ebakchangetb.phome.value=\'DoOpi\';document.ebakchangetb.action=\'phome.php\';">
        &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="删除数据表" onclick="document.ebakchangetb.phome.value=\'DoDrop\';document.ebakchangetb.action=\'phome.php\';">
		&nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="清空数据表" onclick="document.ebakchangetb.phome.value=\'EmptyTable\';document.ebakchangetb.action=\'phome.php\';">
		</div></td>
    </tr>
  </table>
</form>
</body>
</html>';
?>