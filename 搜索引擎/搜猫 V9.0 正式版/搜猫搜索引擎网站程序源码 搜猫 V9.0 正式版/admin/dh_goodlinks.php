<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:;"><a href="?">首页</a><a href="?action=addform&p_cid=';echo $p_cid;echo '">添加</a></div>
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
$db->query("delete from ve123_dh_goodlinks where link_id='".intval($_GET['link_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th>分类名称</th>
    <th width="80">操作</th>
  </tr>
  ';
$result=$db->query('select * from ve123_dh_goodlinks');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['link_id'];echo '</td>
    <td>';echo $rs['title'];;echo '</td>
    <td><a href="?action=modify&link_id=';echo $rs['link_id'];;echo '">修改</a>&nbsp;&nbsp;<a href="?action=del&link_id=';echo $rs['link_id'];;echo '" onClick="if(!confirm(\'确定删除吗?\')) return false;">删除</a></td>
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
$link_id=intval($_GET['link_id']);
$sql="select * from ve123_dh_goodlinks where link_id='$link_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$url=$rs['url'];
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
    <td width="100">名称:</td>
    <td>
      <input name="title" type="text" value="';echo $title;echo '" size="50" /></td>
  </tr>
  <tr>
    <td>网址:</td>
    <td><input name="url" type="text" size="50"  value="';echo $url;echo '"/></td>
  </tr>
  <tr>
    <td>排序ID:</td>
    <td><input type="text" name="sort_id" value="';echo $sort_id;echo '"/></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="link_id" value="';echo $link_id;echo '">
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
$title=trim($_POST['title']);
$url=trim($_POST['url']);
$sort_id=intval($_POST['sort_id']);
$link_id=intval($_POST['link_id']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('title'=>$title,'url'=>$url,'sort_id'=>$sort_id);
$db->update('ve123_dh_goodlinks',$array,"link_id='$link_id'");
jsalert('修改成功');
}
else
{
$array=array('title'=>$title,'url'=>$url,'sort_id'=>$sort_id);
$db->insert('ve123_dh_goodlinks',$array);
jsalert('提交成功');
}
}
;echo '
';
?>