<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'question');
require_once ('include/common.inc.php');
$web_path='./';
$qid=intval($_GET['qid']);

$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE qid=$qid");
$question=$dblink->fetch_array($query);

if($question)
{
	$dblink->query("UPDATE {$tablepre}question SET clickcount=clickcount+1 WHERE qid=$qid");
}
else
{
	show_message('ques_deleted', './');
	exit;
}

$askername=$question['username'];
$title=cut_str($question['title'],40);
$ques_title =$question['title'];
$query_s = $dblink->query("SELECT supplement FROM {$tablepre}question_1 WHERE qid=$qid");
$ques_supplement = $dblink->result($query_s,0);
$ques_supplement = filters_outcontent($ques_supplement);
$ques_status= $question['status'];
$ques_asktime= date("y-m-d H:i",$question['asktime']);
$ques_score = ($ques_status==1 && $question['score']) ? $question['score'] : 0;
if($ques_status==1 || $ques_status==3)
{
	$left_time=($question['endtime']-$timestamp);
	$left_day=floor($left_time/86400);
	$left_hour=floor($left_time%86400/3600);
	$left_day=$left_day>0 ? $left_day : 0;
	$left_hour=$left_hour>0 ? $left_hour : 0;
}
		
$ques_user='<a href="member.php?uid='.$question['uid'].'" target="_blank">'.$question['username'].'</a>';

$ques_allowhandle = (($ques_status==1 || $ques_status==3) && $cyask_uid && $cyask_uid==$question['uid']) ? 1 : 0;
$ques_allowsetvote= ($cyask_uid && $ques_status!=3) ? 1 : 0;
$ques_allowclose  = ($cyask_uid && $ques_status==1) ? 1 : 0;
$ques_allowanswer = ($cyask_uid && $ques_status==1 && $cyask_uid!=$question['uid']) ? 1 : 0;

if($question['sid3'])
{
	$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$question[sid3]");
	$menu=$dblink->fetch_array($query);
	$toplink='<a class="question" href="./browse.php?sortid='.$menu['sid1'].'">'.$menu['sort1'].'</a> &gt;&gt; <a class="question" href="./browse.php?sortid='.$menu['sid2'].'">'.$menu['sort2'].'</a> &gt;&gt; <a class="question" href="./browse.php?sortid='.$menu['sid'].'">'.$menu['sort3'].'</a>';
	$query=$dblink->query("SELECT qid,title FROM {$tablepre}question WHERE sid3=$question[sid3] ORDER BY answercount desc,clickcount desc limit 6");
	$sid_more=$question['sid3'];
}
elseif($question['sid2'])
{
	$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$question[sid2]");
	$menu=$dblink->fetch_array($query);
	$toplink='<a class="question" href="./browse.php?sortid='.$menu['sid1'].'">'.$menu['sort1'].'</a> &gt;&gt; <a class="question" href="./browse.php?sortid='.$menu['sid'].'">'.$menu['sort2'].'</a>';
	$query=$dblink->query("SELECT qid,title FROM {$tablepre}question WHERE sid2=$question[sid2] ORDER BY answercount desc,clickcount desc limit 6");
	$sid_more=$question['sid2'];
}
elseif($question['sid1'])
{
	$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$question[sid1]");
	$menu=$dblink->fetch_array($query);
	$toplink='<a class="question" href="./browse.php?sortid='.$menu['sid'].'">'.$menu['sort1'].'</a>';
	$query=$dblink->query("SELECT qid,title FROM {$tablepre}question WHERE sid1=$question[sid1] ORDER BY answercount desc,clickcount desc limit 6");
	$sid_more=$question['sid1'];
}
$i=1;
while($ques_tmp=$dblink->fetch_array($query))
{
	$ques_tmp['qid']='question.php?qid='.$ques_tmp['qid'];
	$ques_tmp['stitle']=cut_str($ques_tmp['title'],25);
	$hotques_list[$i]=$ques_tmp;
	$i++;
}

if($ques_status==1)
{
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer WHERE qid=$qid");
	$answer_count=$dblink->result($query,0);
	$ques_allowvote = ($answer_count >1) ? 1 :0;

	$query=$dblink->query("SELECT aid,qid,uid,answertime,response FROM {$tablepre}answer WHERE qid=$qid ORDER BY aid asc");
	$answer_list = array();
	while($tmp1=$dblink->fetch_array($query))
	{
		$query_c=$dblink->query("SELECT username,content FROM {$tablepre}answer_1 WHERE aid='$tmp1[aid]'");
		$tmp2 = $dblink->fetch_array($query_c);
		$tmp = array_merge($tmp1,$tmp2);
		
		$tmp['answer']=filters_outcontent($tmp['content']);
		$tmp['time']=date("y-m-d H:i",$tmp['answertime']);
     
		$answer_list[]=$tmp;
	}

	include template('question_nosolve');
	exit();
}	
elseif($ques_status==2)
{
	$query=$dblink->query("SELECT aid,qid,uid,answertime,adopttime,response FROM {$tablepre}answer WHERE qid=$qid AND adopttime<>0  ORDER BY aid desc");
	if($adoptanswer = $dblink->fetch_array($query))
	{
		$query = $dblink->query("SELECT username,content FROM {$tablepre}answer_1 WHERE aid='$adoptanswer[aid]'");
		$adoptanswer2 = $dblink->fetch_array($query);
		$adoptanswer = array_merge($adoptanswer,$adoptanswer2);
	}
	$adoptanswer['answer']=filters_outcontent($adoptanswer['content']);
	$adoptanswer['answertime']=date("y-m-d H:i",$adoptanswer['answertime']);
	$adoptanswer['adopttime']=date("y-m-d H:i",$adoptanswer['adopttime']);
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer WHERE qid=$qid AND adopttime=0");
	$answer_count=$dblink->result($query,0);
	$query=$dblink->query("SELECT aid,qid,uid,answertime,response FROM {$tablepre}answer WHERE qid=$qid AND adopttime=0 ORDER BY aid asc");
	$answer_list = array();
	while($tmp1=$dblink->fetch_array($query))
	{
		$query_c=$dblink->query("SELECT username,content FROM {$tablepre}answer_1 WHERE aid='$tmp1[aid]'");
		$tmp2 = $dblink->fetch_array($query_c);
		$tmp = array_merge($tmp1,$tmp2);
		
		$tmp['answer']=filters_outcontent($tmp['content']);
		$tmp['time']=date("y-m-d H:i",$tmp['answertime']);
     
		$answer_list[]=$tmp;
	}

	include template('question_solve');
	exit();
}	
elseif($ques_status==3)
{  
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer WHERE qid=$qid AND joinvote=1");
	$vote_count=$dblink->result($query,0);
	
	$query=$dblink->query("SELECT aid,qid,uid,votevalue,answertime,response FROM {$tablepre}answer WHERE qid=$qid AND joinvote=1 ORDER BY aid asc");
    
    $vote_list = array();
    $i=1;
    while($tmp1=$dblink->fetch_array($query))
    {
		$query_c=$dblink->query("SELECT username,content FROM {$tablepre}answer_1 WHERE aid='$tmp1[aid]'");
		$tmp2 = $dblink->fetch_array($query_c);
		$tmp = array_merge($tmp1,$tmp2);
		
		$tmp['answer']=filters_outcontent($tmp['content']);
		$tmp['time']=date("y-m-d H:i",$tmp['answertime']);
     
		$vote_list[$i]=$tmp;
		$i++;
	}
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer WHERE qid=$qid AND joinvote<>1");
	$answer_count=$dblink->result($query,0);
	
	$query=$dblink->query("SELECT aid,qid,uid,answertime,response FROM {$tablepre}answer WHERE qid=$qid AND joinvote<>1 ORDER BY aid desc");
	
	$answer_list = array();
	while($tmp1=$dblink->fetch_array($query))
	{
		$query_c=$dblink->query("SELECT username,content FROM {$tablepre}answer_1 WHERE aid='$tmp1[aid]'");
		$tmp2 = $dblink->fetch_array($query_c);
		$tmp = array_merge($tmp1,$tmp2);
		
		$tmp['answer']=filters_outcontent($tmp['content']);
		$tmp['time']=date("y-m-d H:i",$tmp['answertime']);
     
		$answer_list[]=$tmp;
	}

	include template('question_vote');
	exit();
}
else
{
	include template('question_solve');
	exit();
}
?>