<?php

session_start();
error_reporting(0);
require 'global.php';
require '../include/spider/spider_class.php';
$action=$_GET['action'];
if($action=='add')
{
$oldurl=$url= HtmlReplace(trim($_POST['url']));
$imagecode=trim(HtmlReplace($_POST['code']));
$query=$db->query("select * from ve123_url_submit where url='$url'");
$num=$db->num_rows($query);
if($num==0)
{
$array=array('url'=>$url,'ip'=>ip(),'addtime'=>time());
$db->insert('ve123_url_submit',$array);
}
if($is_tijiao_shoulu==0)
{
$url= GetSiteUrl($url);
$site=$db->get_one("select * from ve123_sites where url='$url'");
if(empty($site))
{
$array=array('url'=>$url,'spider_depth'=>$config['spider_depth'],'indexdate'=>time(),'addtime'=>time());
$db->insert('ve123_sites',$array);
}
$site=$db->get_one("select * from ve123_sites where url='$url'");
if(!empty($site))
{
$row=$db->get_one("select * from ve123_links where url='".$url."'");
if(empty($row))
{
AddAndUpdateUrl($url,'add');
}
else
{
AddAndUpdateUrl($url,'update');
}
if($oldurl!=$url)
{
$row=$db->get_one("select * from ve123_links where url='".rtrim($oldurl,'/')."'");
if(empty($row))
{
AddAndUpdateUrl($oldurl,'add');
}
else
{
AddAndUpdateUrl($oldurl,'update');
}
}
}
}
header('location:success.php');
}
function AddAndUpdateUrl($url,$action)
{
global $db;
$spider=new spider;
$spider->url($url);
$title=$spider->title;
$fulltxt=$spider->fulltxt(800);
$keywords=$spider->keywords;
$description=$spider->description;
$pagesize=$spider->pagesize;
$array=array('url'=>$url,'title'=>$title,'fulltxt'=>$fulltxt,'pagesize'=>$pagesize,'keywords'=>$keywords,'description'=>$description,'updatetime'=>time());
if($action=='add')
{
$db->insert('ve123_links',$array);
}
elseif($action=='update')
{
$db->update('ve123_links',$array,"url='".$url."'");
}
}
;echo '<html>
<head>
<title>快速搜索入口</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="images/maincss.css">
<style type="text/css"><!--
.f13 {font-size: 13px;
	line-height: 18px;}
.f14 {font-size: 14px;}
-->
</style>

<SCRIPT language=javascript>
<!--
function CheckForm(thisForm) {
	if (isEmpty(thisForm.url.value) || (thisForm.url.value == "http://")) {
         	alert("你没有输入网站地址!");
      		thisForm.url.focus();
     		return;
    	}
	else if (thisForm.url.value.indexOf("http://") != 0) {
		alert("您少加了http://,请您再检查一次!");
		thisForm.url.focus();
		return;
	}
	else if (thisForm.url.value.indexOf("http://") != thisForm.url.value.lastIndexOf("http://")) {
		alert("您多加了http://,请您再检查一次!");
		thisForm.url.focus();
		return;
	}
	else
    		thisForm.submit();
}
function isEmpty(value) {
  return ((value == null) || (value.length == 0))
}
//-->
</SCRIPT>


		<FORM name=regform action=?action=add method=post target="_top">
          <table cellspacing=0 cellpadding=0 width=700 align=center border=0>
            <tr>
              <td valign=top class="f13">
      　　　
        <input id=url2 size=50 value=http:// 
                  name=url>
        <input onClick="CheckForm(document.all[\'regform\']);" type=button value="快速提交" name=Submit2>
              </td>
            </tr>
          </table>
		</FORM><br>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
          <tr>
            <th width="100">ID</th>
            <th>地址</th>
            <th width="120">提交时间</th>
            <th width="80">IP</th>
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
;echo '          <tr>
            <td>';echo $rs['submit_id'];echo '</td>
            <td>';echo "<a href=\"".$rs['url']."\" target=\"_blank\">".$rs['url'].'</a>';;echo '</td>
            <td>';echo date('Y-m-d H:i:s',$rs['addtime']);;echo '</td>
            <td><a href="http://www.baidu.com/baidu?word=';echo $rs['ip'];;echo '" target="_blank">';echo $rs['ip'];;echo '</a></td>
          </tr>
          ';
}
;echo '        </table>
		</body>
</html>';
?>