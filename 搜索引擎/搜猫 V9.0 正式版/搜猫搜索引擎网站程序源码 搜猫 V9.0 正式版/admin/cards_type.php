<?php

require 'global.php';
headhtml();
$class_id=intval($_GET['class_id']);
$dopost=HtmlReplace(trim($_POST['dopost']));
$num_new=$_POST['num_new'];
$pname_new=$_POST['pname_new'];
$money_new=$_POST['money_new'];
$check_new=$_POST['check_new'];
if($dopost=='save')
{
$startID = 1;
$endID = $_POST['idend'];
for(;$startID<=$endID;$startID++)
{
$query = '';
$tid = 'ID_'.$startID;
$pname = 'pname_'.$startID;
$money = 'money_'.$startID;
$num = 'num_'.$startID;
$check = 'check_'.$startID;
$tid=HtmlReplace(trim($_POST[''.$tid.'']));
$pname=HtmlReplace(trim($_POST[''.$pname.'']));
$money=HtmlReplace(trim($_POST[''.$money.'']));
$num=HtmlReplace(trim($_POST[''.$num.'']));
$check=HtmlReplace(trim($_POST[''.$check.'']));
if($check==1)
{
if($pname!='')
{
$array=array('pname'=>$pname,'money'=>$money,'num'=>$num);
$array2=array('money'=>$money,'num'=>$num);
$db->update('ve123_moneycard_type',$array,"tid='$tid'");
$db->update('ve123_moneycard_record',$array2,"ctid='$tid'");
}
}
else
{
$db->query("delete from ve123_moneycard_type where tid='$tid'");
$db->query("delete from ve123_moneycard_record where ctid='$tid' AND isexp<>-1 ");
}
}
if(isset($check_new) &&$pname_new!='')
{
$array3=array('pname'=>$pname_new,'money'=>$money_new,'num'=>$num_new);
$db->insert('ve123_moneycard_type',$array3);
}
echo "<script> alert('成功更新点卡产品分类表！'); </script>";
}
;echo '  <form name="form1" action="cards_type.php" method="post">
    <input type="hidden" name="dopost" value="save">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg class_nav">
    <tr bgcolor="#FBFCE2">
      <td width="26%" height="24" align="center" valign="top">产品名称</td>
      <td width="27%" align="center" valign="top">点数(金币数)</td>
      <td width="30%" align="center">价格</td>
      <td width="17%" align="center">状态</td>
    </tr>
	';
$result=$db->query('select * from ve123_moneycard_type');
$k=0;
while($rs=$db->fetch_array($result))
{
$k++;
;echo '     <input type="hidden" name="ID_';echo $k;echo '" value="';echo $rs['tid'];echo '">
     <tr align="center" bgcolor="#FFFFFF">
      <td height="24" valign="top">
      	<input name="pname_';echo $k;echo '" value="';echo $rs['pname'];echo '" type="text" id="pname_';echo $k;echo '" style="width:90%" />
      </td>
      <td height="24" valign="top">
      	<input name="num_';echo $k;echo '" value="';echo $rs['num'];echo '" type="text" id="num_';echo $k;echo '" style="width:80%" />
      </td>
      <td>
      	<input name="money_';echo $k;echo '" value="';echo $rs['money'];echo '" type="text" id="money_';echo $k;echo '"  style="width:80%" />
       (元)
	   </td>
      <td>
	  <input name="check_';echo $k;echo '" type="checkbox" id="check_';echo $k;echo '"  value="1" checked=\'1\' class=\'np\' />
        保留
	   </td>
    </tr>
	';
}
;echo '   <input type="hidden" name="idend" value="';echo $k;echo '">
    <tr bgcolor="#F8FCF1">
      <td height="24" colspan="4" valign="top" bgcolor="#F9FCEF" style="padding-left:10px;"><strong>新增一个点卡产品类型：</strong></td>
    </tr>
    <tr height="24" align="center" bgcolor="#FFFFFF">
      <td valign="top">
      	<input name="pname_new" type="text" id="pname_new" class=\'pubinputs\' style="width:90%" />
      </td>
      <td valign="top">
      	<input name="num_new" value="100" type="text" id="num_new" class=\'pubinputs\' style="width:80%" />
      </td>
      <td valign="top">
      	<input name="money_new" type="text" id="money_new" class=\'pubinputs\' style=\'width:80%\' value="30" />
        (元)
      </td>
      <td align="center" bgcolor="#FFFFFF">
	  <input name="check_new" type="checkbox"  id="check_new" value="1" checked=\'1\' class=\'np\' />
        新增 </td>
    </tr>
    <tr>
      <td height="34" colspan="4" align="center" bgcolor="#F9FCEF">
      	<input type="submit" class="np coolbg" value="确定" />
      </td>
    </tr>
</table>

</form>
';
?>