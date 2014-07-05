<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'member');
require('./include/common.inc.php');
$command = empty($command) ? 'info': $command;

$uid= isset($_GET['uid']) ? intval($_GET['uid']) : intval($_POST['uid']);

$query=$dblink->query("select username from {$tablepre}member where uid=$uid");
if(!$dblink->num_rows($query))
{
	show_message('username_error', './');
	exit;
}
$username = $dblink->result($query,0);

if($command=='info')
{
	$query = $dblink->query("select username,email,gender,bday,qq,msn,signature from {$tablepre}member where uid=$uid");
	$members = $dblink->fetch_array($query);
	$member_username=$members['username'];
	$member_email=$members['email'];
	$member_gender=$members['gender'];
	$member_bday=$members['bday'];
	$member_qq=$members['qq'];
	$member_msn=$members['msn'];
	$member_signature=$members['signature'];
}
elseif($command=='score')
{
	$totalscore= get_score($uid);
	
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$uid");
	$answercount=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$uid and adopttime<>0");
	$adoptcount=$dblink->result($query,0);
	
	if($answercount)
	{
		$rightvalage=$adoptcount/$answercount*100;
		$rightvalage=round($rightvalage).'%';
	}
	else
	{
		$rightvalage='0%';
	}
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid");
	$question_allcount=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid and status=2");
	$questionOK=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid and status=1");
	$questionASK=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid and status=3");
	$questionVOTE=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid and status=4");
	$questionCLOSE=$dblink->result($query,0);
	unset($query);
}
elseif($command=='question')
{
	$members=$dblink->fetch_array($query);
	$page=intval($_GET['page']);
	if($page<1) $page=1;
	$pagerow=10;
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$uid and status in(1,2,3)");
	$quescount=$dblink->result($query,0);     
	$pagecount=ceil($quescount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("select * from {$tablepre}question where uid=$uid and status in(1,2,3) limit $pagestart,$pagerow");
	
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['stitle']=cut_str($ques_temp['title'],54);
		$ques_temp['asktime']=date("y-n-j",$ques_temp['asktime']);
		$ques_list[] = $ques_temp;
	}
	unset($query);
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks = get_pages($page,$pagecount,'command='.$command.'&uid='.$uid);
}
elseif($command=='answer')
{
	$members=$dblink->fetch_array($query);
	$page=intval($_GET['page']);
	if($page<1) $page=1;
	$pagerow=10;
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$uid");
	$answercount=$dblink->result($query,0);     
	$pagecount=ceil($answercount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("select a.aid,a.qid,a.answertime,a.response,a.adopttime,q.title,q.status,q.score,q.answercount from {$tablepre}answer a,{$tablepre}question q WHERE a.uid=$uid AND a.qid=q.qid limit $pagestart,$pagerow");
	
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['stitle']=cut_str($ques_temp['title'],54);
		$ques_temp['answertime']=date("y-n-j",$ques_temp['answertime']);
		$ques_list[] = $ques_temp;
	}
	
	unset($query);
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks = get_pages($page,$pagecount,'command='.$command.'&uid='.$uid);
}
else
{
	show_message('action_error', './');
	exit;
}

include template('member');
?>