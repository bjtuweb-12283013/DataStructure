<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'noticelist');
require('./include/common.inc.php');
$title=$site_name;
$query=$dblink->query("SELECT id,title,url,time FROM {$tablepre}notice ORDER BY orderid asc");
$i=1;
while($row=$dblink->fetch_array($query))
{
	$row['id']= empty($row['url']) ? 'notice.php?id='.$row['id'] : $row['url'];
	$row['time']=date("y-n-j",$row['time']);
	$notice_list[$i]=$row;
	$i++;
}
include template('noticelist');
?>