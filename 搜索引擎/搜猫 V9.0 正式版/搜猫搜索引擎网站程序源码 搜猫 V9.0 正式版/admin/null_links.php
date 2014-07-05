<?php

require 'global.php';
set_time_limit(0);
$action=HtmlReplace(trim($_GET['action']));
$title=HtmlReplace(trim($_GET['title']));
$url=HtmlReplace(trim($_GET['url']));
$keywords=HtmlReplace(trim($_GET['keywords']));
switch($action)
{
case 'saveform':
saveform();
break;
case 'update':
add_update_link($_GET['url'],'','','update');
break;
case 'update_all_links':
update_all_links();
break;
case 'add_all_links':
add_all_links($_GET['url']);
break;
case 'del':
del();
break;
case 'dolistform':
dolistform();
break;
}
headhtml();
;echo '<div class="nav" style="display:none;"><a href="?action=add">添加</a></div>
';
if($action=='add')
{
addform($action);
}
elseif($action=='modify')
{
addform($action);
}
;echo '';
$where=" where title<>''";
if($action=='search')
{
if(!empty($title))
{
$where.=" and title like '%".$title."%'";
}
if(!empty($url))
{
$where.=" and url like '%".$url."%'";
}
if(!empty($keywords))
{
$where.=" and CONCAT(title,' ',keywords,' ',fulltxt) like '%".$keywords."%'";
}
}
$sql="select * from ve123_links where title=''";
$sql_count="select link_id from ve123_links where title=''";
$result=$db->query($sql_count);
$total=$db->num_rows($result);
$pagesize=30;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$result=$db->query($sql." order by link_id desc limit $offset,$pagesize");
echo pageshow($page,$totalpage,$total,'?title='.$title.'&keywords='.$keywords.'&url='.$url.'&action='.$action.'&');
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th width="50">ID</th>
    <th>网址</th>
    <th>更新日期</th>
    <th>&nbsp;</th>
    <th>操作</th>
    <th width="50">选择</th>
  </tr><form id="listform" name="listform" method="post" action="?action=dolistform" onsubmit="return checkform();">
  ';
while($row=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $row['link_id'];;echo '</td>
    <td title="';echo $row['title'];;echo '"><a target="_blank" href="';echo $row['url'];;echo '">';echo $row['url'];;echo '</a></td>
    <td>';echo date('Y-m-d H:i:s',$row['updatetime']);;echo '</td>
    <td>';echo $row['level'];;echo '</td>
    <td><a href="?action=modify&link_id=';echo $row['link_id'].'&url='.$row['url'].'';;echo '">修改</a>&nbsp;
	<a href="?action=del" onClick="if(!confirm(\'确定删除吗?\')) return false;">一键删除</a></td>
    <td><input type="checkbox" name="link_id[]" value="';echo $row['link_id'];echo '" /></td>
  </tr>
  ';
}
;echo '  <tr>
    <th colspan="6">
<div align="center"> 
                <input name="chkall" type="checkbox" id="chkall" onclick=CheckAll(this.form,\'link_id[]\') value="checkbox">
                选中本页显示的信息 <strong>操作：</strong> 
                
				<input name="do_action" type="radio" value="del" checked="checked">
                删除&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="submit" name="Submit" value=" 执 行 ">
        </div>	</th>
    </tr></form>
</table>
';
echo pageshow($page,$totalpage,$total,'?title='.$title.'&url='.$url.'&action='.$action.'&');
;echo '';
function addform($do_action)
{
global $db;
if($do_action=='modify')
{
$link_id=intval($_GET['link_id']);
$row=$db->get_one("select * from ve123_links where link_id='$link_id'");
$title=$row['title'];
$url=$row['url'];
$tuiguang=$row['tuiguang'];
$bt_txt='确定修改';
}
else
{
$bt_txt='确定添加';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<tr>
    <th colspan="2">网站</th>
  </tr>
  <form id="addform" name="addform" method="post" action="?action=saveform">
  <tr>
    <td width="100">网址:</td>
    <td><input name="url" type="text" value="';echo GetSiteUrl($url);;echo '" size="50"/></td>
  </tr>
  <tr>
    <td>推广:</td>
    <td><input type="text" name="tuiguang"  value="';echo $tuiguang;;echo '"/>
      (值越大排名越靠前)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="link_id" value="';echo $link_id;;echo '" />
	<input type="hidden" name="do_action" value="';echo $do_action;;echo '" />
	<input type="submit" name="Submit" value="';echo $bt_txt;;echo '" />	</td>
  </tr>
</form>
</table>

';
}
;echo '';
function saveform()
{
global $db;
$url=HtmlReplace(trim($_POST['url']));
$tuiguang=intval(trim($_POST['tuiguang']));
$do_action=HtmlReplace($_POST['do_action']);
if($do_action=='modify')
{
$link_id=intval($_POST['link_id']);
$sql="update ve123_links set url='$url',tuiguang='$tuiguang' where link_id='$link_id'";
$db->query($sql);
jsalert('修改成功');
}
else
{
$query=$db->query("select * from ve123_links where url='$url'");
$num=$db->num_rows($query);
if(!$num)
{
add_update_link($url,'','','add');
jsalert('添加成功');
}
}
}
function add_all_links($url)
{
global $db;
$sql="select * from ve123_links where url like '%".$url."%'";
$result=$db->query($sql);
$total=$db->num_rows($result);
$pagesize=5;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$query=$db->query($sql." limit $offset,$pagesize");
$str="<html><head><title></title><link rel=\"stylesheet\" href=\"images/maincss.css\">";
$str.="<meta http-equiv='Content-Type' content='text/html; charset=gb2312'></head><body >";
$str.='<b>网站正在收录中……请稍候!<br>';
while($row=$db->fetch_array($query))
{
add_links($row['url'],false);
$str.=$row['url'].'<br>';
}
$str.="<meta http-equiv=\"refresh\" content=3;url='?action=add_all_links&url=".$url.'&page='.($page+1)."'>";
$str.='</body></html>';
echo $str;
}
function add_links($url,$is_index_page=true,$num='')
{
global $db;
$new_links=array();
$j=1;
$url_htmlcode=get_url_content($url);
$url_htmlcode=get_encoding($url_htmlcode,'GB2312');
$links=get_links($url_htmlcode,$url,1,$url);
if($is_index_page)
{
foreach($links as $value)
{
$new_links[]=GetSiteUrl($value);
}
}
else
{
$new_links=$links;
}
$new_links = distinct_array($new_links);
foreach($new_links as $value)
{
echo $value.'<br>';
flush();
$query=$db->query("select * from ve123_links where url='$value'");
$num=$db->num_rows($query);
if($num==0)
{
if(!add_update_link($value,'','','add'))
{
continue;
}
$j++;
if(!empty($num))
{
if($j>=$num)
{
exit;
}
}
}
}
}
function update_all_links()
{
global $db;
$day=intval($_GET['day']);
if(!empty($day))
{
$sql="select * from ve123_links where updatetime<='".(time()-(86400*$day))."'";
}
else
{
$sql='select * from ve123_links';
}
$result=$db->query($sql);
$total=$db->num_rows($result);
if($total<=0){header('location:links.php');exit;}
$pagesize=5;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$query=$db->query($sql." limit $offset,$pagesize");
$str="<html><head><title></title><link rel=\"stylesheet\" href=\"images/maincss.css\">";
$str.="<meta http-equiv='Content-Type' content='text/html; charset=gb2312'></head><body >";
$str.="<b>网站正在更新中……请稍候！<font color='red'>在此过程中请勿刷新此页面！！！</font></b><br>总共需要更新 <font color='red'><b>$total</b></font> 个网站，每页更新 <font color='red'><b>$pagesize</b></font> 个网站，共需要分 <font color='red'><b>$totalpage</b></font> 页更新，当前正在更新 <font color='red'><b>$page</b></font> 页<br>";
while($row=$db->fetch_array($query))
{
add_update_link($row['url'],'','','update');
$str.=$row['url'].'<br>';
}
if($page<=$totalpage)
{
$str.="<meta http-equiv=\"refresh\" content=3;url='?action=update_all_links&day=".$day.'&page='.($page+1)."'>";
$str.='</body></html>';
}
else
{
$str.='更新完毕<br>';
$str.="<a href=\"links.php\">返回上一页</a>";
$str.='</body></html>';
}
echo $str;
exit;
}
function del()
{
global $db;
$db->query("delete from ve123_links where title=''");
jsalert('删除成功');
}
function dolistform()
{
global $db;
$link_id=$_POST['link_id'];
$do_action=HtmlReplace($_POST['do_action']);
for($i=0;$i<count($link_id);$i++)
{
$link_id_str=$link_id_str.$link_id[$i].',';
}
$link_id_str=rtrim($link_id_str,',');
if(empty($link_id_str)){return;}
if($do_action=='del')
{
$sql='delete from ve123_links where link_id in('.$link_id_str.')';
}
$db->query($sql);
header('location:'.$_SERVER['HTTP_REFERER']);
}

?>