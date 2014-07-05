<?php

require 'global.php';
headhtml();
$class_id=intval($_GET['class_id']);
;echo '<div class="nav" style="display:;"><a href="?">首页</a><a href="?action=addform&class_id=';echo $class_id;echo '">添加</a></div>

<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg class_nav">
  <tr>
    <td align="center">
	';
$result=$db->query('select * from ve123_dh_class');
while($rs=$db->fetch_array($result))
{
if($rs['class_id']==$class_id)
{
echo "<a href=\"?class_id=$rs[class_id]\" class=\"selectstyle\">$rs[classname]</font></a>";
}
else
{
echo "<a href=\"?class_id=$rs[class_id]\">$rs[classname]</a>";
}
}
;echo '    </td>
  </tr>
</table>
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
$db->query("delete from ve123_dh_links where link_id='".intval($_GET['link_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th>名称</th>
    <th>网址</th>
    <th width="80">分类</th>
    <th width="100">操作</th>
  </tr>
  ';
if(empty($class_id))
{
}
else
{
$where=" where a.class_id='".$class_id."'";
}
$result=$db->query("select a.*,b.* from ve123_dh_links a left join ve123_dh_class b on a.class_id=b.class_id$where order by a.class_id asc");
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['sid'];echo '</td>
    <td><a href="?action=modify&link_id=';echo $rs['link_id'];echo '">';echo $rs['title'];echo '</a></td>
    <td>';echo $rs['url'];echo '</td>
    <td>';echo $rs['classname'];;echo '</td>
    <td><a href="?action=modify&link_id=';echo $rs['link_id'];echo '&class_id=';echo $rs['class_id'];;echo '">修改</a>&nbsp;&nbsp;<a href="?action=del&link_id=';echo $rs['link_id'];;echo '" onClick="if(!confirm(\'确定删除吗?\')) return false;">删除</a></td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db,$cid;
if ($do_action=='modify')
{
$link_id=intval($_GET['link_id']);
$sql="select * from ve123_dh_links where link_id='$link_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$url=$rs['url'];
$class_id=$rs['class_id'];
$btn_txt='确定修改';
}
else
{
$class_id=intval($_GET['class_id']);
$btn_txt='确定添加';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td>类别:</td>
    <td>
	<select name="class_id">
	';
$result=$db->query('select * from ve123_dh_class');
while($rs=$db->fetch_array($result))
{
if($rs['class_id']==$class_id)
{
$selectedstr=" selected=\"selected\"";
}
else
{
$selectedstr='';
}
echo "<option$selectedstr value=\"$rs[class_id]\">$rs[classname]</option>";
}
;echo '    </select>	</td>
  </tr>
  <tr>
    <td width="100">名称:</td>
    <td>
      <input name="title" type="text" value="';echo $title;echo '" /></td>
  </tr>
  <tr>
    <td>URL:</td>
    <td><input name="url" type="text" value="';echo $url;echo '" size="80" /></td>
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
$title=HtmlReplace(trim($_POST['title']));
$url=HtmlReplace(trim($_POST['url']));
$class_id=intval($_POST['class_id']);
$link_id=intval($_POST['link_id']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('title'=>$title,'url'=>$url,'class_id'=>$class_id);
$db->update('ve123_dh_links',$array,"link_id='$link_id'");
jsalert('修改成功');
}
else
{
$array=array('title'=>$title,'url'=>$url,'class_id'=>$class_id);
$db->insert('ve123_dh_links',$array);
jsalert('提交成功');
}
}
;echo '
';
?>