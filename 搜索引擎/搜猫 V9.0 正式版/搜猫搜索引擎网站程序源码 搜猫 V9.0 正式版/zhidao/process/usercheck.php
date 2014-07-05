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

$username = trim($_GET['username']);
$query = $dblink->query("select count(*) from {$tablepre}member WHERE username='$username'");
$usercount = $dblink->result($query,0);
	
if($usercount == 0)
{
	echo 'yes';
	exit;
}
elseif($usercount > 0)
{
	echo 'no';
	exit;
}
else
{
	echo 'error';
	exit;
}
?>