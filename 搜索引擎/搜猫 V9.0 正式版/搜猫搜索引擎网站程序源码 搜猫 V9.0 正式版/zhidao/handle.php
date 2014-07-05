<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'handle');
require_once ('./include/common.inc.php');
$qid= empty($_GET['qid']) ? $_POST['qid'] : $_GET['qid'];
$qid=intval($qid);

if(!$cyask_uid)
{
	$referer=get_referer();
	header("location:login.php?url=$referer");
	exit;
}

$url=empty($_GET['url']) ? $_POST['url'] : $_GET['url'];

if($command=='ques_supply')
{
	$query=$dblink->query("select title from {$tablepre}question where qid=$qid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	$title=$site_name;
	$question=$dblink->fetch_array($query);
	$ques_title=$question['title'];
	$query_s = $dblink->query("SELECT supplement FROM {$tablepre}question_1 WHERE qid=$qid");
	$ques_supplement = $dblink->result($query_s,0);
	$ques_supplement=filters_outcontent($ques_supplement);
	
	include template('handle_ques_supply');
}
elseif($command=='ques_supply_submit')
{
	$newsupplement=filters_content($_POST['supplement']);
	if(check_submit($_POST['supllysubmit'], $_POST['formhash']))
	{
		$query=$dblink->query("UPDATE {$tablepre}question_1 SET supplement='$newsupplement' WHERE qid=$qid");
		header("location:signal.php?resultno=102&url=$url");
		exit;
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
elseif($command=='answer_adopt')
{
	$query=$dblink->query("SELECT title,score FROM {$tablepre}question WHERE qid=$qid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	
	$title=$site_name;
	$ques_row=$dblink->fetch_array($query);
	$ques_title=$ques_row['title'];
	$quesscore=$ques_row['score'] ? $ques_row['score'] : 0;
	$my_score=get_score($cyask_uid);
	
	$query=$dblink->query("select aid,uid,answertime from {$tablepre}answer WHERE aid=$_POST[aid]");
	$answer_row=$dblink->fetch_array($query);
	$query=$dblink->query("select username,content from {$tablepre}answer_1 WHERE aid=$_POST[aid]");
	$answer_row2=$dblink->fetch_array($query);
	$answer_row=array_merge($answer_row,$answer_row2);
	
	$answerid=intval($answer_row['aid']);
	$ques_answer=filters_outcontent($answer_row['content']);
	$answertime=$answer_row['answertime'];
	$answer_user='<a href="member.php?uid='.$answer_row['uid'].'" target="_blank">'.$answer_row['username'].'</a>';
	
	include template('handle_answer_adopt');
}
elseif($command=='answer_adopt_submit')
{
	$aid=intval($_POST['aid']);
	$query=$dblink->query("SELECT qid,uid FROM {$tablepre}answer WHERE aid=$aid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	$answer=$dblink->fetch_array($query);
	
	if(check_submit($_POST['adoptsubmit'], $_POST['formhash']))
	{
		$content=filters_content($_POST['content']);
		$allscore=intval($_POST['score']+$_POST['addscore']+$score_adopt);
		$addscore=intval($_POST['addscore']);
		$my_score=get_score($cyask_uid);
		if($addscore>$my_score)
		{
			show_message('score_error', '');
			exit;
		}
		$dblink->query("UPDATE {$tablepre}question SET status=2 WHERE qid=$answer[qid]");
		$dblink->query("UPDATE {$tablepre}answer SET adopttime=$timestamp,response=response+1 WHERE aid=$aid");
		$dblink->query("INSERT INTO {$tablepre}res SET aid=$aid,uid=$cyask_uid,username='$cyask_user',content='$content',time=$timestamp");
		if($allscore)
		{
			update_score($cyask_uid,$addscore,'-');
			update_score($answer['uid'],$allscore,'+');
		}
        header("location:signal.php?resultno=108&url=$url");
		exit;
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
elseif($command=='ques_addscore')
{
	$query=$dblink->query("select title,score from {$tablepre}question where qid=$qid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	$title=$site_name;
	$question=$dblink->fetch_array($query);
	$ques_title=$question['title'];
	$ques_score=$question['score'];
	$my_score=get_score($cyask_uid);
	include template('handle_ques_addscore');
}
elseif($command=='ques_addscore_submit')
{
	$query=$dblink->query("select count(*) from {$tablepre}question where qid=$qid");
	if(!$dblink->result($query,0))
	{
		show_message('action_error', './');
		exit;
	}
	if(check_submit($_POST['addscoresubmit'], $_POST['formhash']))
	{
		$addscore=intval($_POST['addscore']);
		$my_score=get_score($cyask_uid);
		if($addscore>$my_score)
		{
			show_message('score_error', '');
			exit;
		}
		else
		{
			$dblink->query("UPDATE {$tablepre}question SET score=score+$addscore,endtime=endtime+432000 WHERE qid=$qid");
			update_score($cyask_uid,$addscore,'-');
			header("location:signal.php?resultno=106&url=$url");
			exit;
		}
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
elseif($command=='ques_close')
{
	$query=$dblink->query("select count(*) from {$tablepre}question where qid=$qid");
	if(!$dblink->result($query,0))
	{
		show_message('action_error', './');
		exit;
	}
	$title=$site_name;
	$query=$dblink->query("select title,score,answercount from {$tablepre}question where qid=$qid");
	$question=$dblink->fetch_array($query);
	$ques_title=$question['title'];
	$ques_score=$question['score'];
	$answercount=$question['answercount'];
	include template('handle_ques_close');
}
elseif($command=='ques_close_submit')
{
	$query=$dblink->query("select score from {$tablepre}question where qid=$qid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	if(check_submit($_POST['quesclosesubmit'], $_POST['formhash']))
	{
		$ques_score=$dblink->result($query,0);
		$dblink->query("UPDATE {$tablepre}question SET status=4 where qid=$qid");
		update_score($cyask_uid,$ques_score,'+');
        header("location:signal.php?resultno=107&url=$url");
		exit;
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
elseif($command=='ques_vote')
{
	$query=$dblink->query("select title,score from {$tablepre}question where qid=$qid");
	if(!$dblink->num_rows($query))
	{
		show_message('action_error', './');
		exit;
	}
	$title=$site_name;
	
	$question=$dblink->fetch_array($query);
	$ques_title=$question['title'];
	$ques_score=$question['score'];
	
	$query=$dblink->query("select * from {$tablepre}answer where qid=$qid");
    $i=1;
    while($row=$dblink->fetch_array($query))
    {
		$row['id']=$i;
		$query_c=$dblink->query("select * from {$tablepre}answer_1 where aid='$row[aid]'");
		$row_c=$dblink->fetch_array($query_c);
		$row=array_merge($row,$row_c);
		$row['content']=cut_str($row['content'],200);
		$answer_list[$i]=$row;
		$i++;
	}
	
	include template('handle_ques_setvote');
}
elseif($command=='ques_vote_submit')
{
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE qid=$qid");
	if(!$dblink->result($query,0))
	{
		show_message('action_error', './');
		exit;
	}
	if(check_submit($_POST['quesvotesubmit'], $_POST['formhash']))
	{
		$dblink->query("UPDATE {$tablepre}question SET status=3 WHERE qid=$qid");
		
		$vote_list=explode("|",$_POST[vote_list]);
		$vote_count=count($vote_list);
		for($i=0;$i<$vote_count;$i++)
		{
			$dblink->query("UPDATE {$tablepre}answer SET joinvote=1 WHERE aid={$vote_list[$i]}");
		}
		header("location:signal.php?resultno=104&url=$url");
		exit;
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
?>