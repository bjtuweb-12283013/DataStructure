<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'msgcheck');
require '../include/common.inc.php';

if($cyask_uid)
{
	$query = $dblink->query("select count(*) from {$tablepre}message WHERE touid=$cyask_uid and mstate=0");
	$msgcount = $dblink->result($query,0);
	$msgcount = $msgcount ? $msgcount:0;
	echo $msgcount;
	exit;
}
else
{
	echo 0;
	exit;
}
?>