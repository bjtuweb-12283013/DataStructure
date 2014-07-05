<?php

error_reporting(0);
set_time_limit(0);
require('global.php');
require_once(PATH.'include/spider/spider_class.php');
$spider=new spider;
headhtml();
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <td><form id="form1" name="form1" method="post" action="?action=start">
      <input type="submit" name="Submit" value="¿ªÊ¼Ò»¼üÕÒÕ¾" />
        </form>
    </td>
  </tr>
</table>
';
$action=HtmlReplace(trim($_GET['action']));
switch($action)
{
case 'start':
start();
break;
}
function start()
{
global $spider;
echo 'ÕıÔÚ´¦ÀíÖĞ...<br>';
print str_repeat(' ',4096);
ob_flush();
flush();
$url='http://www.hao123.com/';
$spider->url($url);
$fulltxt=$spider->fulltxt(800);
$links= $spider->links();
$sites= $spider->sites();
foreach($links as $value)
{
$num=count(explode($url,$value));
if($num==2)
{
$spider->url($url);
$sites= $spider->sites();
add_sites($sites);
}
}
}
;echo '';
function add_sites($array)
{
global $db,$spider;
foreach($array as $value)
{
$row=$db->get_one("select * from ve123_links where url='".$value."'");
{
if(empty($row))
{
echo $value.'<br>';
$spider->url($value);
$title=$spider->title;
$fulltxt=$spider->fulltxt(800);
$keywords=$spider->keywords;
$description=$spider->description;
$pagesize=$spider->pagesize;
$htmlcode=$spider->htmlcode;
$array=array('url'=>$value,'title'=>$title,'fulltxt'=>$fulltxt,'pagesize'=>$pagesize,'keywords'=>$keywords,'description'=>$description,'addtime'=>time(),'updatetime'=>time());
$db->insert('ve123_links',$array);
file_put_contents(PATH.'k/www/'.base64_encode($value),$htmlcode);
}
else
{
echo 'ÒÑ´æÔÚ:'.$value.'<br>';
}
ob_flush();
flush();
}
}
}

?>