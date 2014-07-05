<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'vote');
require_once ('./include/common.inc.php');
$aid= empty($_GET['aid']) ? $_POST['aid'] : $_GET['aid'];
$aid=intval($aid);

$query=$dblink->query("SELECT aid,qid FROM {$tablepre}answer WHERE aid=$aid");
if(!$dblink->num_rows($query))
{
	show_message('action_error', './');
	exit;
}
$answer=$dblink->fetch_array($query);
if($cyask_uid)
{
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}vote WHERE qid=$answer[qid] AND uid=$cyask_uid");
}
else
{
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}vote WHERE qid=$answer[qid] AND uip='$onlineip'");
}
if($dblink->result($query,0))
{
	$referer=get_referer();
	show_message('vote_more', $referer);
	exit;
}
if(check_submit($_POST['votesubmit'], $_POST['formhash']))
{
	$dblink->query("INSERT INTO {$tablepre}vote SET qid=$answer[qid],aid=$aid,uid=$cyask_uid,uip='$onlineip'");
	$dblink->query("UPDATE {$tablepre}answer SET votevalue=votevalue+1 where aid=$aid");
	$referer=get_referer();
	header("location:signal.php?resultno=112&url=$referer");
	exit;
}
else
{
	show_message('url_error', './');
	exit;
}
?>