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
$rs=$db->get_one('select * from ve123_siteconfig');
;echo '<form id="configform" name="configform" method="post" action="?action=saveconfig">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th colspan="2">网站基本设置</th>
  </tr>
  <tr>
    <td width="120">网站名称:</td>
    <td><input type="text" name="name" value="';echo $rs['name'];echo '"/></td>
  </tr>
  <tr>
    <td>蜘蛛名称:</td>
    <td><input type="text" name="user_agent" value="';echo $rs['user_agent'];;echo '"/></td>
  </tr>
  <tr>
    <td>网站地址:</td>
    <td><input type="text" name="url" value="';echo $rs['url'];;echo '"/></td>
  </tr>
  <tr>
    <td>搜索页顶部标题:</td>
    <td><input name="adtitle" type="text" value="';echo $rs['adtitle'];echo '" size="20"/></td>
  </tr>
  <tr>
    <td>IPC备案:</td>
    <td><input type="text" name="icp" value="';echo $rs['icp'];;echo '"/></td>
  </tr>
  <tr>
    <td>QQ:</td>
    <td><input type="text" name="qq" value="';echo $rs['qq'];;echo '"/></td>
  </tr>
  <tr>
    <td>是否马上收录:</td>
    <td><input name="is_tijiao_shoulu" type="checkbox" value="1" ';if($rs['is_tijiao_shoulu']){echo "checked=\"checked\"";};echo ' />
      (网友提交登录入口后是否马上收录网页)</td>
  </tr>
  <tr>
    <td>蜘蛛默认收录深度:</td>
    <td><input type="text" name="spider_depth" value="';echo $rs['spider_depth'];;echo '"/>
      (0表示只收首页,1表示收首页上的网页,2,3,4,以此类推)</td>
  </tr>
  <tr>
    <td>Keywords:</td>
    <td><textarea name="Keywords" cols="50" rows="5">';echo $rs['Keywords'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>description:</td>
    <td><textarea name="description" cols="50" rows="5">';echo $rs['description'];;echo '</textarea></td>
  </tr>
  <tr>
    <td>关键词过滤：</td>
    <td><textarea name="filter_word" cols="50" rows="5">';echo $rs['filter_word'];;echo '</textarea>
      （提示：词与词关请以&quot;,&quot;号隔开）</td>
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
$icp=HtmlReplace($_POST['icp']);
$url=HtmlReplace($_POST['url']);
$status_content=HtmlReplace($_POST['status_content']);
$statcode=$_POST['statcode'];
$Keywords=HtmlReplace($_POST['Keywords']);
$description=$_POST['description'];
$telephone=$_POST['telephone'];
$qq=$_POST['qq'];
$spider_depth=intval($_POST['spider_depth']);
$is_tijiao_shoulu=$_POST['is_tijiao_shoulu'];
$filter_word=$_POST['filter_word'];
$array=array('name'=>$name,'user_agent'=>$user_agent,'adtitle'=>$adtitle,'copyright'=>$copyright,'icp'=>$icp,'statcode'=>$statcode,'url'=>$url,'status_content'=>$status_content,'Keywords'=>$Keywords,'description'=>$description,'telephone'=>$telephone,'qq'=>$qq,'is_tijiao_shoulu'=>$is_tijiao_shoulu,'spider_depth'=>$spider_depth,'filter_word'=>$filter_word);
$db->update('ve123_siteconfig',$array,"config_id='1'");
$config=$db->get_one('select * from ve123_siteconfig limit 1');
$str.='<?php'.chr(13).chr(10);
$str.="\$config['name']=\"".$name."\";".chr(13).chr(10);
$str.="\$config['user_agent']=\"".$user_agent."\";".chr(13).chr(10);
$str.="\$config['adtitle']=\"".$adtitle."\";".chr(13).chr(10);
$str.="\$config['copyright']=\"".$copyright."\";".chr(13).chr(10);
$str.="\$config['icp']=\"".$icp."\";".chr(13).chr(10);
$str.="\$config['url']=\"".$url."\";".chr(13).chr(10);
$str.="\$config['status_content']=\"".$status_content."\";".chr(13).chr(10);
$str.="\$config['statcode']=\"".addslashes($statcode)."\";".chr(13).chr(10);
$str.="\$config['Keywords']=\"".$Keywords."\";".chr(13).chr(10);
$str.="\$config['description']=\"".$description."\";".chr(13).chr(10);
$str.="\$config['telephone']=\"".$telephone."\";".chr(13).chr(10);
$str.="\$config['qq']=\"".$qq."\";".chr(13).chr(10);
$str.="\$config['is_tijiao_shoulu']=\"".$is_tijiao_shoulu."\";".chr(13).chr(10);
$str.="\$config['spider_depth']=".$spider_depth.';'.chr(13).chr(10);
$str.="\$config['author']=\"".$config['author']."\";".chr(13).chr(10);
$str.="\$config['copyright']=\"".$copyright."\";".chr(13).chr(10);
$str.="\$config['filter_word']=".var_export(explode(',',$filter_word),true).';'.chr(13).chr(10);
$str.='?>';
$fp=@fopen('../cache/site_config.php','w') or die('写方式打开文件失败，请检查程序目录是否为可写');
@fputs($fp,$str) or die('文件写入失败,请检查程序目录是否为可写');
@fclose($fp);
jsalert ('修改成功!');
}
;echo '
';
?>