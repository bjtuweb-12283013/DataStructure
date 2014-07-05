<?php

require 'global.php';
headhtml();
$ad_class=array('1'=>'搜索页右侧低部','2'=>'搜索页右侧(有说明显示)','3'=>'首页广告位');
$type=intval($_GET['type']);
;echo '<div class="nav" style="display:;"><a href="?action=addform&type=';echo $type;;echo '">添加</a></div>
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
$ad_id=intval($_GET['ad_id']);
$db->query("delete from ve123_ad where ad_id='".$ad_id."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav" style="display:none">
  <tr>
    <td>
	';
foreach($ad_class as $key=>$value)
{
if($type==$key)
{
$class=" class=\"selectstyle\"";
}
else
{
$class='';
}
echo '<a'.$class." href=\"?type=".$key."\">".$value.'</a>';
}
;echo '</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav">
  <tr>
    <td>';echo $ad_class[$type];;echo '</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th width="100">网站名称</th>
    <th>链接地址</th>
    <th width="80">是否显示</th>
    <th width="80">排序ID</th>
    <th width="80">操作</th>
  </tr>
  ';
if(!empty($type))
{
$where=" where type='".$type."'";
}
$sql='select * from ve123_ad'.$where.' order by sortid asc';
$result=$db->query($sql);
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['ad_id'];echo '</td>
    <td>';echo $rs['title'];echo '</td>
    <td>';echo "<a href=\"".$rs['siteurl']."\" target=\"_blank\">".$rs['siteurl'].'</a>';;echo '</td>
    <td>
	';
if($rs['is_show'])
{
echo '√';
}
else
{
echo "<font color=\"red\">×</font>";
}
;echo '	</td>
    <td>';echo $rs['sortid'];;echo '</td>
    <td><a href="?action=modify&amp;ad_id=';echo $rs['ad_id'];echo '&type=';echo $rs['type'];;echo '">修改</a>
	<a href="?action=del&ad_id=';echo $rs['ad_id'];;echo '" onclick="if(!confirm(\'确认删除码?\')) return false;">删除</a>	</td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db,$type;
if ($do_action=='modify')
{
$ad_id=$_GET['ad_id'];
$sql="select * from ve123_ad where ad_id='$ad_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$siteurl=$rs['siteurl'];
$type=$rs['type'];
$content=$rs['content'];
$sortid=$rs['sortid'];
$is_show=$rs['is_show'];
$btn_txt='确定修改';
}
else
{
$btn_txt='确定提交';
$is_show=1;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">网站名称:</td>
    <td>
      <input name="title" type="text" value="';echo $title;echo '" size="80"/>    </td>
  </tr>
  <tr>
    <td>链接地址:</td>
    <td><input name="siteurl" type="text" value="';echo $siteurl;echo '" size="80" /></td>
  </tr>
  <tr ';if($do_action=='modify'){echo "style=\"display:none;\"";};echo '>
    <td>显示类型:</td>
    <td><input name="type" type="radio" value="1" ';if($type==1) echo "checked=\"checked\"";;echo ' />
    搜索页右侧
      <input type="radio" name="type" value="2" ';if($type==2) echo "checked=\"checked\"";;echo '/>
      搜索页右侧(有说明显示)
	   <input type="radio" name="type" value="3" ';if($type==3) echo "checked=\"checked\"";;echo '/>
      首页广告位	  </td>
  </tr>
  <tr>
    <td>排序ID:</td>
    <td><input type="text" name="sortid"  value="';echo $sortid;echo '"/></td>
  </tr>
  <tr>
    <td>是否显示:</td>
    <td><input name="is_show" type="checkbox" value="1" ';if($is_show){echo "checked=\"checked\"";};echo ' /></td>
  </tr>
  <tr>
    <td>详细说明:</td>
    <td><textarea name="content" cols="80" rows="8">';echo $content;;echo '</textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="ad_id" value="';echo $ad_id;echo '">
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
$siteurl=trim($_POST['siteurl']);
$type=trim($_POST['type']);
$content=trim($_POST['content']);
$ad_id=$_POST['ad_id'];
$sortid=intval($_POST['sortid']);
$is_show=intval($_POST['is_show']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
$db->update('ve123_ad',$array,"ad_id='$ad_id'");
jsalert('修改成功');
}
else
{
$array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
$db->insert('ve123_ad',$array);
jsalert('提交成功');
}
}
;echo '
';
?>