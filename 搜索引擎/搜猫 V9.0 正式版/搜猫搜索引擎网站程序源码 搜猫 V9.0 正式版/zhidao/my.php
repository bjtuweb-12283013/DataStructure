<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'my');
require './include/common.inc.php';

if(!$cyask_uid)
{
	$url='my.php';
	header("location:login.php?url=$url");
	exit;
}

$command= empty($command) ? 'myscore': $command;

if($command=='myscore')
{
	$query=$dblink->query("select allscore from {$tablepre}member where uid=$cyask_uid");
	$totalscore=$dblink->result($query,0);
	
	$lastweek=get_weeks()-1;
	$query=$dblink->query("select sum(score) from {$tablepre}score where uid=$cyask_uid and week=$lastweek");
	$lastweekscore=$dblink->result($query,0);
	
	$year=intval(date("Y"));
	$month=date("n")-1;
	$month=intval($month);
	if(!$month)
	{
		$year=$year-1;
		$month=12;
	}
	$lastmonth=intval($year.$month);
	$query=$dblink->query("select sum(score) from {$tablepre}score where uid=$cyask_uid and month=$lastmonth");
	$lastmonthscore=$dblink->result($query,0);
	
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$cyask_uid");
	$answercount=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$cyask_uid and adopttime<>0");
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
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$cyask_uid");
	$question_allcount=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$cyask_uid and status=2");
	$questionOK=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$cyask_uid and status=1");
	$questionASK=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$cyask_uid and status=3");
	$questionVOTE=$dblink->result($query,0);
	$query=$dblink->query("select count(*) from {$tablepre}question where uid=$cyask_uid and status=4");
	$questionCLOSE=$dblink->result($query,0);
	unset($query);
}
elseif($command=='myask')
{
	$page=intval($_GET['page']);
	if($page<1) $page=1;
	$pagerow=10;
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE uid=$cyask_uid AND status IN (1,2,3)");
	$quescount=$dblink->result($query,0);     
	$pagecount=ceil($quescount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("SELECT qid,title,status,score,asktime,answercount FROM {$tablepre}question where uid=$cyask_uid AND status IN (1,2,3) ORDER BY asktime desc LIMIT $pagestart,$pagerow");
	
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['stitle']=cut_str($ques_temp['title'],54);
		$ques_temp['asktime']=date("y-n-d",$ques_temp['asktime']);
		$ques_list[] = $ques_temp;
	}
	unset($query);
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks = get_pages($page,$pagecount,'command='.$command);
}
elseif($command=='myoverdue')
{
	$page=intval($_GET['page']);
	if($page<1) $page=1;
	$pagerow=10;
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE uid=$cyask_uid AND endtime<$timestamp AND status IN (1,3)");
	$quescount=$dblink->result($query,0);     
	$pagecount=ceil($quescount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("SELECT qid,title,status,score,asktime,answercount FROM {$tablepre}question where uid=$cyask_uid AND endtime<$timestamp AND status IN (1,3) ORDER BY asktime desc LIMIT $pagestart,$pagerow");
	
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['stitle']=cut_str($ques_temp['title'],54);
		$ques_temp['asktime']=date("y-n-j",$ques_temp['asktime']);
		$ques_list[] = $ques_temp;
	}
	unset($query);
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks = get_pages($page,$pagecount,'command='.$command);
}
elseif($command=='myanswer')
{
	$page=intval($_GET['page']);
	if($page<1) $page=1;
	$pagerow=10;
	$query=$dblink->query("select count(*) from {$tablepre}answer where uid=$cyask_uid");
	$answercount=$dblink->result($query,0);     
	$pagecount=ceil($answercount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("SELECT a.aid,a.answertime,a.adopttime,a.response,q.title,q.status,q.score,q.answercount FROM {$tablepre}answer AS a,{$tablepre}question AS q WHERE a.uid=$cyask_uid AND a.qid=q.qid ORDER BY a.answertime DESC LIMIT $pagestart,$pagerow");
	
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['stitle']=cut_str($ques_temp['title'],54);
		$ques_temp['answertime']=date("y-n-d",$ques_temp['answertime']);
		$ques_list[] = $ques_temp;
	}
	
	unset($query,$query2);
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks = get_pages($page,$pagecount,'command='.$command);
}
elseif($command=='mymessage')
{
	$boxtype = isset($_POST['boxtype']) ? $_POST['boxtype'] : $_GET['boxtype'];
	$boxtype = $boxtype ? $boxtype : 'inbox';
	if($boxtype == 'inbox')
	{
		$where = "touid=$cyask_uid";
	}
	else
	{
		$where = "fromuid=$cyask_uid";
	}
	
	$page = intval($_GET['page']);
	$page = $page ? $page : 1;
	$pagerow=10;
	$query=$dblink->query("select count(*) from {$tablepre}message WHERE $where");
	$msgcount=$dblink->result($query,0);     
	$pagecount=ceil($msgcount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}message WHERE $where ORDER BY mstate ASC,mdate DESC LIMIT $pagestart,$pagerow");
	$msg_list = array();
	while($temp=$dblink->fetch_array($query))
	{
		$temp['mbody'] = strip_tags($temp['mbody']);
		$temp['mbody'] = cut_str($temp['mbody'],30);
		$temp['mdate'] = date("Y-m-d H:i",$temp['mdate']);
		$msg_list[] = $temp;
	}
	
	$page_front	=$page-1;
	$page_next	=$page+1;
	$parameter = 'command='.$command.'&boxtype='.$boxtype.'&msgtype='.$msgtype;
	$pagelinks = get_pages($page,$pagecount,$parameter);
	
}
elseif($command=='sendmsg')
{
	if(isset($_POST['submit']))
	{
		if(check_submit($_POST['submit'], $_POST['formhash']))
		{
			$mbody = strip_tags($_POST['content']);
			$mbody = nl2br($mbody);
			$tousername = trim($_POST['username']);
			$query = $dblink->query("select uid from {$tablepre}member where username='$tousername'");
			$touid = $dblink->result($query,0);
			$mkey = get_message_key($cyask_uid, $touid);
			$mdate = time();
			$query = $dblink->query("insert into {$tablepre}message set mkey='$mkey',touid='$touid',tousername='$tousername',fromuid='$cyask_uid',fromusername='$cyask_user',mbody='$mbody',mdate='$mdate'");
			if($query)
			{
				$dourl='my.php?command=mymessage&boxtype=outbox';
				show_message('sendmsg_succeed', $dourl);
				exit;
			}
			else
			{
				$dourl='my.php?command=mymessage&boxtype=outbox';
				show_message('sendmsg_usernull', $dourl);
				exit;
			}
		}
		else
		{
			show_message('url_error', './');
			exit;
		}
	}
}
elseif($command=='readmsg')
{
	$mid = intval($_GET['mid']);
	$mkey = trim($_GET['mkey']);
	
	$dblink->query("update {$tablepre}message set mstate=1 where mid=$mid and touid=$cyask_uid");
	
	$reply_uid = 0;
	$reply_username = '';
    $query = $dblink->query("SELECT * FROM {$tablepre}message WHERE mkey='$mkey' order by mdate");
	$msg_list = array();
	while($temp=$dblink->fetch_array($query))
	{
		if(!$reply_uid && empty($reply_username))
		{
			if($cyask_uid == $temp['touid'])
			{
				$reply_uid = $temp['fromuid'];
				$reply_username = $temp['fromusername'];
			}
			else
			{
				$reply_uid = $temp['touid'];
				$reply_username = $temp['tousername'];
			}
		}
		
		$temp['mdate'] = date("Y-m-d H:i",$temp['mdate']);
		$msg_list[] = $temp;
	}
	
}
elseif($command=='replymsg')
{
	$boxtype = $_POST['boxtype'];
	$page = intval($_POST['page']);
	$mkey = trim($_POST['mkey']);
	$reply_uid = intval($_POST['reply_uid']);
	$reply_username = trim($_POST['reply_username']);
	
	if(check_submit($_POST['submit'], $_POST['formhash']))
	{
		$mbody = strip_tags($_POST['content']);
		$mbody = nl2br($mbody);
		$mdate = time();
		$query = $dblink->query("insert into {$tablepre}message set mkey='$mkey',touid='$reply_uid',tousername='$reply_username',fromuid='$cyask_uid',fromusername='$cyask_user',mbody='$mbody',mdate='$mdate'");
		if($query)
		{
			$backurl='my.php?command=mymessage&boxtype='.$boxtype.'&page='.$page;
			show_message('sendmsg_succeed', $backurl);
			exit;
		}
		else
		{
			$backurl='my.php?command=mymessage&boxtype='.$boxtype.'&page='.$page;
			show_message('sendmsg_error', $backurl);
			exit;
		}
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
elseif($command=='myinfo')
{
	$query=$dblink->query("select * from {$tablepre}member where uid=$cyask_uid");
	$members=$dblink->fetch_array($query);
	$members['signature'] = nl2br($members['signature']);
	unset($query);
	
}
elseif($command=='upinfo')
{
	$query=$dblink->query("select * from {$tablepre}member where uid=$cyask_uid");
	$members=$dblink->fetch_array($query);
	unset($query);
}
elseif($command=='upinfosubmit')
{
	if(check_submit($_POST['upinfosubmit'], $_POST['formhash']))
	{
		$query=$dblink->query("update {$tablepre}member set gender='$_POST[gender]',bday='$_POST[bday]',qq='$_POST[qq]',msn='$_POST[msn]',signature='$_POST[signature]' where uid=$cyask_uid");

		$backurl='my.php?command=myinfo';
		show_message('upinfo_succeed', $backurl);
		exit;
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
	
}
elseif($command=='uppassword')
{
}
elseif($command=='uppwsubmit')
{
	if(check_submit($_POST['uppwsubmit'], $_POST['formhash']))
	{
		$email = trim($_POST['email']);
		$oldpw = md5($_POST['opw']);
		$newpw = md5($_POST['npw']);
		
		$query = $dblink->query("select password,email from {$tablepre}member where uid='$cyask_uid'");
		$member = $dblink->fetch_array($query);
		
		if($member['email'] != $email)
		{
			$backurl='my.php?command=uppassword';
			show_message('uppw_error_2', $backurl);
			exit;
		}
		
		if($member['password'] != $oldpw)
		{
			$backurl='my.php?command=uppassword';
			show_message('uppw_error_1', $backurl);
			exit;
		}
		
		$dblink->query("update {$tablepre}member set password='$newpw' where uid='$cyask_uid'");
			
		$backurl='my.php?command=myinfo';
		show_message('uppw_succeed', $backurl);
		exit;
	
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
	
}
elseif($command=='delmessage')
{
	$mid = intval($_GET['mid']);
	$dblink->query("delete from {$tablepre}message where mid=$mid");
	
	$referer=get_referer();
	show_message('delmessage_succeed', $referer);
	exit;
}
else
{
	show_message('action_error', './');
	exit;
}
include template('my');
?>