<?php

require 'global.php';
headhtml();
;echo '<style type="text/css">
<!--
.STYLE1 {
	color: #0000FF;
	font-weight: bold;
}
.STYLE3 {
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
.STYLE4 {color: #0000FF}
-->
</style>

';
$action=$_GET['action'];
switch ($action)
{
case 'saveform':
saveform();
break;
case 'addform':
addform($action);
break;
case 'modify':
addform($action);
break;
case 'del':
$db->query("delete from ve123_admin where admin_id='".intval($_GET['admin_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="75">ID</th>
    <th width="174">用户名</th>
	<th width="198">密码</th>
    <th width="219">本次登录IP</th>
    <th width="185">上次登录IP</th>
  </tr>
  ';
$result=$db->query('select * from ve123_admin ');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['admin_id'];;echo '</td>
    <td>';echo $rs['adminname'];;echo '</td>
	<td>提示：暂不显示!!</td>
    <td>';echo $rs['loginip'];;echo '</td>
    <td>';echo $rs['lastloginip'];;echo '</td>
    <td width="129">
	<a href="?action=modify&admin_id=';echo $rs['admin_id'];;echo '">修改密码</a>&nbsp;&nbsp;
	<a href="?action=del&admin_id=';echo $rs['admin_id'];;echo '" onClick="if(!confirm(\'确定删除吗?\')) return false;">删除</a></td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db,$p_cid;
if ($do_action=='modify')
{
$admin_id=intval($_GET['admin_id']);
$sql="select * from ve123_admin where admin_id='$admin_id'";
$rs=$db->get_one($sql);
$adminname=$rs['adminname'];
$password=$rs['password'];
$admin_id=$rs['admin_id'];
$btn_txt='确定修改';
}
else
{
$btn_txt='确定添加';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">用户名:</td>
    <td>
      <input name="adminname" type="text" value="';echo $adminname;echo '" size="50" /></td>
  </tr>
    <tr>
      <td>密码:</td>
      <td>
      <input name="password" type="text" size="50" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="admin_id" value="';echo $admin_id;echo '">
	<input type="hidden" name="do_action" value="';echo $do_action;echo '">
	<input type="submit" name="Submit" value="';echo $btn_txt;echo '" />	</td>
  </tr>
  </form>
</table>
<p>
  ';
}
;echo '  
  ';
function saveform()
{
global $db;
$adminname=trim($_POST['adminname']);
$password=trim($_POST['password']);
$admin_id=intval($_POST['admin_id']);
$do_action=$_POST['do_action'];
if($password=='')
{
jsalert('密码不能为空,请输入密码!');
die();
}
if ($do_action=='modify')
{
$array=array('adminname'=>$adminname,'password'=>$password,'admin_id'=>$admin_id);
$db->update('ve123_admin',$array,"admin_id='$admin_id'");
jsalert('修改成功');
}
else
{
$array=array('adminname'=>$adminname,'password'=>$password,'admin_id'=>$admin_id);
$db->insert('ve123_admin',$array);
jsalert('提交成功');
}
}
;echo '</p>
<div class="nav" style="display:;"><a href="admin.php">首页</a><a href="?action=addform&amp;p_cid=';echo $p_cid;echo '">添加管理员</a></div>
<p>&nbsp; </p>
';
?>