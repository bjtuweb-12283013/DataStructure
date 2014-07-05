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

<div class="nav" style="display:;"><a href="http://www.cmd5.com/" target="_blank" class="STYLE1">MD5值解密</a><a href="?">首页</a><a href="?action=addform&p_cid=';echo $p_cid;echo '">添加</a></div>
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
$db->query("delete from ve123_zz_user where user_id='".intval($_GET['user_id'])."'");
break;
}
;echo '<table width="100%" height="68" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th width="39" height="35">ID</th>
    <th width="118">用户名</th>
    <th width="271">密码</th>
    <th width="101">积分</th>
    <th width="197">邮箱</th>
    <th width="157"><p>客户类型</p>
        <p>（0.普通客户 1.代理）</p></th>
  </tr>
  ';
$result=$db->query('select * from ve123_zz_user');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['user_id'];;echo '</td>
    <td>';echo $rs['user_name'];;echo '</td>
    <td>';echo $rs['password'];;echo '</td>
    <td>';echo $rs['points'];;echo '</td>
    <td>';echo $rs['email'];;echo '</td>
    <td>';echo $rs['user_group'];;echo '</td>
    <td width="90"><a href="?action=modify&user_id=';echo $rs['user_id'];;echo '">修改</a>&nbsp;&nbsp; <a href="?action=del&user_id=';echo $rs['user_id'];;echo '" onclick="if(!confirm(\'确定删除吗?\')) return false;">删除</a></td>
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
$user_id=intval($_GET['user_id']);
$sql="select * from ve123_zz_user where user_id='$user_id'";
$rs=$db->get_one($sql);
$user_name=$rs['user_name'];
$password=$rs['password'];
$email=$rs['email'];
$user_group=$rs['user_group'];
$user_id=$rs['user_id'];
$points=$rs['points'];
$sort_id=$rs['sort_id'];
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
      <input name="user_name" type="text" value="';echo $user_name;echo '" size="50" /></td>
  </tr>
    <tr>
      <td>密码:</td>
      <td>
      <input name="password" type="text" value="';echo $password;echo '" size="50" />
      <span class="STYLE3"> 注意：</span><span class="STYLE4">这里可以直接输入密码，无需输入MD5值。</span></td>
  </tr>
  <tr>
    <td>积分:</td>
    <td><input name="points" type="text" value="';echo $points;echo '" size="50" /></td>
  </tr>
  <tr>
    <tr>
      <td>邮箱:</td>
    <td><input name="email" type="text" size="50"  value="';echo $email;echo '"/></td>
  </tr>
  <tr>
    <tr>
      <td>客户类型:</td>
    <td><input name="user_group" type="text" size="50"  value="';echo $user_group;echo '"/>
      <span class="STYLE3">注意：</span><span class="STYLE4">请输入数字：（0.普通客户 2.代理）</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="user_id" value="';echo $user_id;echo '">
	<input type="hidden" name="do_action" value="';echo $do_action;echo '">
	<input type="submit" name="Submit" value="';echo $btn_txt;echo '" />	</td>
  </tr>
  </form>
</table>
';
}
;echo '
';
function saveform()
{
global $db;
$user_name=trim($_POST['user_name']);
$password=trim($_POST['password']);
$email=trim($_POST['email']);
$user_group=trim($_POST['user_group']);
$user_id=intval($_POST['user_id']);
$points=trim($_POST['points']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('user_name'=>$user_name,'password'=>md5($password),'email'=>$email,'user_group'=>$user_group,'user_id'=>$user_id,'points'=>$points);
$db->update('ve123_zz_user',$array,"user_id='$user_id'");
jsalert('修改成功');
}
else
{
$array=array('user_name'=>$user_name,'password'=>md5($password),'email'=>$email,'user_group'=>$user_group,'user_id'=>$user_id,'points'=>$points);
$db->insert('ve123_zz_user',$array);
jsalert('提交成功');
}
}
;echo '
';
?>