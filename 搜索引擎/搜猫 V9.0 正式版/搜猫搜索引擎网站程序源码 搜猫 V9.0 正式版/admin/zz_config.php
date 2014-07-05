<?php

require 'global.php';
headhtml();
$action=$_GET['action'];
switch ($action)
{
case 'saveconfig':
saveconfig();
break;
}
$rs=$db->get_one('select * from ve123_zz_config');
;echo '<form id="configform" name="configform" method="post" action="?action=saveconfig">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th colspan="2">网站基本设置</th>
  </tr>
  <tr>
    <td width="120">关键词最低起价:</td>
    <td><input type="text" name="default_point" value="';echo $rs['default_point'];echo '"/>
      (积分)</td>
  </tr>
  <tr>
    <td>会员注册赠送积分:</td>
    <td><input type="text" name="zs_points" value="';echo $rs['zs_points'];echo '"/>
      (积分)</td>
  </tr>
  <tr>
    <td>如何获得积分说明:</td>
    <td><textarea name="getpoints" cols="80" rows="8">';echo $rs['getpoints'];;echo '</textarea>
      (支持HTML代码)</td>
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
$default_point=intval($_POST['default_point']);
$zs_points=intval($_POST['zs_points']);
$getpoints=my_addslashes($_POST['getpoints']);
$array=array('default_point'=>$default_point,'getpoints'=>$getpoints,'zs_points'=>$zs_points);
$db->update('ve123_zz_config',$array,"config_id='1'");
$config=$db->get_one('select * from ve123_zz_config limit 1');
$str.='<?php'.chr(13).chr(10);
$str.="\$zz_config['default_point']=".$default_point.';'.chr(13).chr(10);
$str.="\$zz_config['zs_points']=".$zs_points.';'.chr(13).chr(10);
$str.="\$zz_config['getpoints']=\"".$getpoints."\";".chr(13).chr(10);
$str.='?>';
$fp=@fopen('../cache/zz_config.php','w') or die('写方式打开文件失败，请检查程序目录是否为可写');
@fputs($fp,$str) or die('文件写入失败,请检查程序目录是否为可写');
@fclose($fp);
jsalert ('修改成功!');
}
;echo '
';
?>