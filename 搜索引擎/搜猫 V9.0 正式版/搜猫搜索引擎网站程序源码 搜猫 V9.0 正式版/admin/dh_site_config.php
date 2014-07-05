<?php

require 'global.php';
headhtml();
$action=HtmlReplace($_GET['action']);
switch ($action)
{
case 'saveconfig':
saveconfig();
break;
}
$rs=$db->get_one('select * from ve123_dh_siteconfig');
;echo '<form id="configform" name="configform" method="post" action="?action=saveconfig">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th colspan="2">导航基本设置</th>
  </tr>
  <tr>
    <td width="100">导航名称:</td>
    <td><input type="text" name="name" value="';echo $rs['name'];echo '"/></td>
  </tr>
  <tr>
    <td>广告标题:</td>
    <td><input name="adtitle" type="text" value="';echo $rs['adtitle'];echo '" size="80"/></td>
  </tr>
  <tr>
    <td>电话:</td>
    <td><input type="text" name="telephone" value="';echo $rs['telephone'];;echo '"/></td>
  </tr>
  <tr>
    <td>QQ:</td>
    <td><input type="text" name="qq" value="';echo $rs['qq'];;echo '"/></td>
  </tr>
  <tr>
    <td>公告:</td>
    <td>
      <textarea name="notice" cols="50" rows="5">';echo $rs['notice'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>keywords:</td>
    <td><textarea name="keywords" cols="50" rows="5">';echo $rs['keywords'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>description:</td>
    <td><textarea name="description" cols="50" rows="5">';echo $rs['description'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>状态内容:</td>
    <td><textarea name="status_content" cols="50" rows="5">';echo $rs['status_content'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>网站统计代码:</td>
    <td><textarea name="statcode" cols="50" rows="5">';echo $rs['statcode'];echo '</textarea></td>
  </tr>
  <tr>
    <td>网站版权:</td>
    <td><textarea name="copyright" cols="50" rows="5">';echo $rs['copyright'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="提交" /></td>
  </tr>
</table>
</form>
';
function saveconfig()
{
global $db;
$name=HtmlReplace($_POST['name']);
$user_agent=HtmlReplace($_POST['user_agent']);
$adtitle=$_POST['adtitle'];
$copyright=$_POST['copyright'];
$url=HtmlReplace($_POST['url']);
$searchcode=$_POST['searchcode'];
$status_content=HtmlReplace($_POST['status_content']);
$statcode=$_POST['statcode'];
$description=$_POST['description'];
$notice=HtmlReplace($_POST['notice']);
$keywords=HtmlReplace($_POST['keywords']);
$telephone=$_POST['telephone'];
$qq=$_POST['qq'];
$array=array('name'=>$name,'keywords'=>$keywords,'adtitle'=>$adtitle,'copyright'=>$copyright,'icp'=>$icp,'statcode'=>$statcode,'url'=>$url,'searchcode'=>$searchcode,'status_content'=>$status_content,'description'=>$description,'telephone'=>$telephone,'qq'=>$qq,'notice'=>$notice);
$db->update('ve123_dh_siteconfig',$array,"sid='1'");
jsalert ('修改成功!');
}
;echo '
';
?>