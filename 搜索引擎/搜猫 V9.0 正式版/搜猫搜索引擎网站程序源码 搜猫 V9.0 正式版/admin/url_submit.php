<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:none;"><a href="?action=addform">添加</a></div>
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
case 'dell_all_submit':
$db->query('delete from ve123_url_submit');
break;
case 'del':
$submit_id=intval($_GET['submit_id']);
$db->query("delete from ve123_url_submit where submit_id='".$submit_id."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <td><a onclick="if(!confirm(\'确认删除码?\')) return false;" href="?action=dell_all_submit">删除所提交网站</a></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th>地址</th>
    <th width="120">提交时间</th>
    <th width="80">IP</th>
    <th width="80">操作</th>
  </tr>
  ';
$sql='select * from ve123_url_submit';
$result=$db->query($sql);
$total=$db->num_rows($result);
$pagesize=30;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$result=$db->query($sql." order by submit_id desc limit $offset,$pagesize");
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['submit_id'];echo '</td>
    <td>';echo "<a href=\"".$rs['url']."\" target=\"_blank\">".$rs['url'].'</a>';;echo '</td>
    <td>';echo date('Y-m-d H:i:s',$rs['addtime']);;echo '</td>
    <td>';echo $rs['ip'];;echo '</td>
    <td>
	<a href="?action=modify&amp;submit_id=';echo $rs['submit_id'];echo '">修改</a>
	<a href="?action=del&submit_id=';echo $rs['submit_id'];;echo '" onclick="if(!confirm(\'确认删除码?\')) return false;">删除</a>	</td>
  </tr>
  ';
}
;echo '</table>
';
echo pageshow($page,$totalpage,$total,'?');
;echo '';
function addform($do_action)
{
global $db;
if ($do_action=='modify')
{
$submit_id=$_GET['submit_id'];
$sql="select * from ve123_url_submit where submit_id='$submit_id'";
$rs=$db->get_one($sql);
$url=$rs['url'];
$ip=$rs['ip'];
$btn_txt='确定修改';
}
else
{
$btn_txt='确定提交';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">链接地址:</td>
    <td><input name="url" type="text" value="';echo $url;echo '" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="submit_id" value="';echo $submit_id;echo '">
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
$url=trim($_POST['url']);
$submit_id=$_POST['submit_id'];
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('url'=>$url);
$db->update('ve123_url_submit',$array,"submit_id='$submit_id'");
jsalert('修改成功');
}
else
{
$array=array('url'=>$url,'ip'=>ip());
$db->insert('ve123_url_submit',$array);
jsalert('提交成功');
}
}
;echo '
';
?>