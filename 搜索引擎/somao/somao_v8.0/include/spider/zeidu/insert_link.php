<link rel="stylesheet" href="xp.css" type="text/css">
<?php
set_time_limit(0);
//error_reporting(0);
require "global.php";
echo "正在检查网址中...<br>";
print str_repeat(" ", 4096);
ob_flush();
flush();
sleep(1);
$url=$_GET["url"];
if(empty($url)){echo tips("网址不能为空!");die();}
insert_links($url);
GetUrl_AllSite(GetSiteUrl($url));
$db->close();
?>