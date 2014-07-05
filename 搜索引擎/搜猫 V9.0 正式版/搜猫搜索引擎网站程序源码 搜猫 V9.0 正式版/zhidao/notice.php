<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'notice');
require('./include/common.inc.php');
$title=$site_name;
$id=intval($_GET['id']);
$query=$dblink->query("select * from {$tablepre}notice where id=$id");
$row=$dblink->fetch_array($query);
$notice['title']=$row['title'];
$notice['time'] =date("y-n-j",$row['time']);
$notice['author']=$row['author'];
$notice['content']=filters_outcontent($row['content']);
include template('notice');
?>
