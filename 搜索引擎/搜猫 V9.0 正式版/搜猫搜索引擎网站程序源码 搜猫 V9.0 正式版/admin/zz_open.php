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
$db->query("delete from ve123_zz_open where link_id='".intval($_GET['link_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th width="99">关键词</th>
    <th width="188">网页标题</th>
    <th width="170">URL 地址</th>
    <th width="120">最后提交时间</th>
    <th width="80">操作</th>
  </tr>
  ';
$result=$db->query('select * from ve123_zz_open');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['link_id'];echo '</td>
    <td>';echo $rs['keywords'];;echo '</td>
    <td>';echo $rs['title'];;echo '</td>
    <td>';echo "<a target=\"_blank\" href=\"".$rs['url']."\">".$rs['url'].'</a>';;echo '</td>
    <td>';echo date('Y-m-d H:i:s',$rs['updatetime']);;echo '</td>
    <td><a href="?action=modify&link_id=';echo $rs['link_id'];;echo '">查看</a>&nbsp;&nbsp;<a href="?action=del&link_id=';echo $rs['link_id'];;echo '" onClick="if(!confirm(\'确定删除吗?\')) return false;">删除</a></td>
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
$sql="select * from ve123_zz_open where link_id='$link_id'";
$rs=$db->get_one($sql);
$keywords=$rs['keywords'];
$title=$rs['title'];
$url=$rs['url'];
$description=$rs['description'];
$jscode=$rs['jscode'];
$price=$rs['price'];
$pic=$rs['pic'];
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
    <td width="100">关键词:</td>
    <td>
      <input name="keywords" type="text" value="';echo $keywords;echo '" size="50" /></td>
  </tr>
  <tr>
    <td>网页标题:</td>
    <td><input name="title" type="text" value="';echo $title;echo '" size="50" /></td>
  </tr>
  <tr>
    <td>URL 地址:</td>
    <td><input name="url" type="text" value="';echo $url;echo '" size="50" /></td>
  </tr>
  <tr>
    <td>品牌代码:</td>
    <td><textarea name="description" cols="80" rows="8">';echo $description;echo '</textarea></td>
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
$keywords=trim($_POST['keywords']);
$title=trim($_POST['title']);
$url=trim($_POST['url']);
$description=trim($_POST['description']);
$jscode=my_addslashes(trim($_POST['jscode']));
$price=trim($_POST['price']);
$pic=trim($_POST['pic']);
$link_id=intval($_POST['link_id']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('keywords'=>$keywords,'title'=>$title,'url'=>$url,'description'=>$description,'jscode'=>$jscode,'price'=>$price,'pic'=>$pic);
$db->update('ve123_zz_open',$array,"link_id='$link_id'");
jsalert('修改成功');
}
else
{
$array=array('keywords'=>$keywords,'title'=>$title,'url'=>$url,'description'=>$description,'jscode'=>$jscode,'price'=>$price,'pic'=>$pic);
$db->insert('ve123_zz_open',$array);
jsalert('提交成功');
}
}
;echo '
'
?>