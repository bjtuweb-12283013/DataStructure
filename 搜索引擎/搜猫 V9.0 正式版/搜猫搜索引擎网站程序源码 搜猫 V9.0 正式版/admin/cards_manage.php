<?php

require 'global.php';
headhtml();
$dopost=$_GET['dopost'];
$aids=$_GET['aids'];
$isexp=$_GET['isexp'];
if($dopost=='delete'){
$ids = explode('`',$aids);
$dquery = '';
foreach($ids as $id){
if($dquery=='') $dquery .= "aid='$id' ";
else $dquery .= " OR aid='$id' ";
}
if($dquery!='') $dquery = ' WHERE '.$dquery;
$db->query("DELETE FROM ve123_moneycard_record $dquery");
echo "<script> alert('成功删除指定的记录！'); </script>";
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo $cfg_soft_lang;;echo '">
<title>点卡业务记录</title>

<script language="javascript">
//获得选中项
function getCheckboxItem()
{
	var allSel="";
	if(document.form1.aids.value) return document.form1.aids.value;
	for(i=0;i<document.form1.aids.length;i++)
	{
		if(document.form1.aids[i].checked)
		{
			if(allSel=="")
				allSel=document.form1.aids[i].value;
			else
				allSel=allSel+"`"+document.form1.aids[i].value;
		}
	}
	return allSel;
}
function ReSel()
{
	for(i=0;i<document.form1.aids.length;i++)
	{
		if(document.form1.aids[i].checked) document.form1.aids[i].checked = false;
		else document.form1.aids[i].checked = true;
	}
}
function DelSel()
{
	var nid = getCheckboxItem();
	
	location.href="cards_manage.php?dopost=delete&aids="+nid;
}
</script>
</head>
<body background=\'images/allbg.gif\' leftmargin=\'8\' topmargin=\'8\'>
<table width="98%" border="0" cellpadding="1" cellspacing="1" align="center" class="tbtitle" style="	background:#cfcfcf;">
  <tr>
    <td height="20" colspan="7" bgcolor="#EDF9D5" background=\'images/tbg.gif\'>
    	<table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" style="padding-left:10px;"><strong>点卡业务管理：</strong> </td>
          <td width="45%" align="right" style="padding-top:4px;"> <input type="button" class=\'np coolbg\' name="ss13" value="未使用" style="width:50px;margin-right:6px" onClick="location=\'cards_manage.php?isexp=0\';" >
            <input type="button" class=\'np coolbg inputbut\' name="ss15" value="已使用" style="width:50px;margin-right:6px" onClick="location=\'cards_manage.php?isexp=-1\';">
            <input type="button" class=\'np coolbg inputbut\' name="ss16" value="全部" style="width:40px;margin-right:6px" onClick="location=\'cards_manage.php\';">
          </td>
          <td width="25%" align="right" style="padding-top:4px;"> <input type="button" class=\'np coolbg inputbut\' name="ss1" value="生成点卡" style="width:70px;margin-right:6px" onClick="location=\'cards_make.php\';">
            <input type="button" class=\'np coolbg inputbut\' name="ss12" value="点卡产品分类" style="width:90px;margin-right:6px" onClick="location=\'cards_type.php\';">
          </td>
        </tr>
    </table></td>
  </tr>
  <tr align="center"  bgcolor="#FBFCE2">
    <td width="8%">选择</td>
    <td width="28%">卡号</td>
    <td width="18%">点卡类型</td>
    <td width="12%">生成日期</td>
    <td width="12%">使用日期</td>
    <td width="8%">状态</td>
    <td width="14%">使用会员</td>
  </tr>
  <form name="form1">
';
if($action=='search')
{
$where=' where';
if(!empty($url))
{
$where.=" url like '%".$url."%'";
}
else
{
$where='';
}
}
if(isset($isexp)) $where = " WHERE isexp='$isexp' ";
$sql='select * from ve123_moneycard_record'.$where;
$result=$db->query($sql);
$total=$db->num_rows($result);
$pagesize=30;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$result=$db->query($sql." order by aid desc limit $offset,$pagesize");
while ($row=$db->fetch_array($result))
{
;echo '  <tr align="center" bgcolor="#FFFFFF" height="26" align="center" onMouseMove="javascript:this.bgColor=\'#FCFDEE\';" onMouseOut="javascript:this.bgColor=\'#FFFFFF\';">
    <td><input type=\'checkbox\' name=\'aids\' value=\'';echo $row['aid'];echo '\' class=\'np\'></td>
      <td>';echo $row['cardid'];echo '</td>
      <td>';echo Gettypename($row['ctid']);echo '</td>
      <td>';echo MyDate('Y-m-d  H:i:s',$row['mtime']);echo '</td>
      <td>';echo GetUseDate($row['utime']);echo ' </td>
      <td>';echo GetSta($row['isexp']);echo '</td>
      <td>';echo GetMemberID($row['uid']);echo '</td>
  </tr>
  ';
}
;echo '</form>
  <tr>
    <td height="30" colspan="7" bgcolor="#ffffff">&nbsp;
<input type="button" class=\'np coolbg inputbut\' name="b7" value="反选" style="width:40" onClick="ReSel();">
<input type="button" class=\'np coolbg inputbut\' name="b7" value="删除" style="width:40" onClick="DelSel();">
      　　　　 </td>
  </tr>
  <tr>
    <td height="36" colspan="7" align="center" bgcolor="#F9FCEF">
    ';
echo pageshow($page,$totalpage,$total,'?');
;echo '    </td>
  </tr>
</table>
</body>
</html>

';
function GetMemberID($mid=0)
{
global $db;
$row=$db->get_one("select * from ve123_zz_user where user_id='$mid' ");
if(!empty($mid)) return $row['user_name'];
else return '未使用';
}
function Gettypename($tid)
{
global $db;
$row=$db->get_one("select * from ve123_moneycard_type where tid='$tid' ");
return $row['pname'];
}
function GetUseDate($time=0)
{
if(!empty($time)) return MyDate('',$time);
else return '未使用';
}
function GetSta($sta)
{
if($sta==1) return '已售出';
else if($sta==-1) return '已使用';
else return '未使用';
}
function MyDate($format='Y-m-d H:i:s',$timest=0)
{
global $cfg_cli_time;
$cfg_cli_time = 8;
$addtime = $cfg_cli_time * 3600;
if(empty($format))
{
$format = 'Y-m-d H:i:s';
}
return gmdate ($format,$timest+$addtime);
}
?>