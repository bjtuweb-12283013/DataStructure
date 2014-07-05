<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:;"><a href="?action=addform">添加</a></div>
<script language="javascript">
   function checkform()
   {
         if(document.pageform.title.value==""){alert("标题不能为空!");document.pageform.title.focus();return false;}
   }
</script>
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
$about_id=intval($_GET['about_id']);
$db->query("delete from ve123_fenlei where about_id='".$about_id."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="71">ID</th>
    <th width="238">网页分类</th>
    <th width="106">对应蜘蛛抓取ID</th>
    <th width="67">地址</th>
    <th width="80">操作</th>
  </tr>
  ';
$result=$db->query('select * from ve123_fenlei order by about_id desc');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['about_id'];;echo '</td>
    <td>';echo stripslashes($rs['title']);;echo '</td>
    <td>';echo $rs['urlid'];;echo '</td>
    <td><a href="';echo $config['url'];;echo '/list/?';echo stripslashes($rs['urlid']);;echo '.html" target="_blank">';echo $config['url'];;echo '/list/?';echo stripslashes($rs['urlid']);;echo '.html</a></td>
    <td><a href="?action=modify&amp;about_id=';echo $rs['about_id'];echo '">修改</a>
	<a href="?action=del&about_id=';echo $rs['about_id'];;echo '" onclick="if(!confirm(\'确认删除码?\')) return false;">删除</a>	</td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db;
if ($do_action=='modify')
{
$about_id=$_GET['about_id'];
$sql="select * from ve123_fenlei where about_id='$about_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$content=$rs['content'];
$url=$rs['url'];
$urlid=$rs['urlid'];
$sortid=$rs['sortid'];
$is_show=$rs['is_show'];
$btn_txt='确定修改';
}
else
{
$btn_txt='确定提交';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="pageform" name="pageform" method="post" action="?action=saveform" onsubmit="return checkform()">
  <tr>
    <td width="100">网页分类:</td>
    <td>
      <input name="title" type="text" value="';echo $title;echo '" size="80"/>    </td>
  </tr>
  <tr>
    <td>蜘蛛抓取ID:</td>
    <td><input type="text" name="urlid" value="';echo $urlid;echo '"/></td>
  </tr>
  <tr>
    <td>排序:</td>
    <td><input type="text" name="sortid" value="';echo $sortid;echo '"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="about_id" value="';echo $about_id;echo '">
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
global $db,$config;
$title=addslashes(HtmlReplace(trim($_POST['title'])));
$content=trim($_POST['content']);
$url=HtmlReplace(trim($_POST['url']));
$sortid=intval($_POST['sortid']);
$about_id=intval($_POST['about_id']);
$urlid=intval($_POST['urlid']);
$do_action=HtmlReplace($_POST['do_action']);
$is_show=$_POST['is_show'];
ob_start();
if ($do_action=='modify')
{
$array=array('title'=>$title,'urlid'=>$urlid,'content'=>$content,'url'=>$url,'sortid'=>$sortid,'is_show'=>$is_show);
$db->update('ve123_fenlei',$array,"about_id='$about_id'");
jsalert('修改成功');
}
else
{
$array=array('title'=>$title,'urlid'=>$urlid,'content'=>$content,'url'=>$url,'sortid'=>$sortid,'is_show'=>$is_show);
$db->insert('ve123_fenlei',$array);
jsalert('提交成功');
}
}
;echo '
';
?>