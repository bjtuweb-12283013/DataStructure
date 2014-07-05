<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'ask');
require_once ('./include/common.inc.php');

$title=$site_name;

if(!$cyask_uid)
{
	$url='ask.php?word='.$_GET['word'];
	header("location:login.php?url=$url");
	exit;
}

$time_exceed=strtotime(date("Y-m-d"));
$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE uid=$cyask_uid AND asktime>$time_exceed");
$exceed_count=$dblink->result($query,0);
if($exceed_count >= $count_ques_exceed)
{
	show_message('ques_exceed', '');
	exit;
}
	
$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE uid=$cyask_uid AND status IN(1,3) AND endtime<$timestamp");
$overdue_count=$dblink->result($query,0);
if($overdue_count)
{
	$dourl='my.php?command=myoverdue';
	show_message('ques_overdue', $dourl);
	exit;
}

$ques_title=empty($_GET['word']) ? $_POST['word'] : $_GET['word'];
$ques_title=trim($ques_title);
$ques_count=0;

if($command=='ask')
{
	if(check_submit($_POST['submit'], $_POST['formhash']))
	{
		if(empty($_POST['qtitle']))
		{
			show_message('title_null', '');
			exit;
		}
		$sid=intval($_POST['cid']);
		if($sid)
		{
			$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
			$sortrow=$dblink->fetch_array($query);
			switch($sortrow['grade'])
			{
				case 1 : $sid1=$sortrow['sid'];$sid2=0;$sid3=0;break;
				case 2 : $sid1=$sortrow['sid1'];$sid2=$sortrow['sid'];$sid3=0;break;
				case 3 : $sid1=$sortrow['sid1'];$sid2=$sortrow['sid2'];$sid3=$sortrow['sid'];break;
			}
		}
		else
		{
			show_message('class_error', '');
			exit;
		}
		$give_score=intval($_POST['givescore']);
		if($give_score)
		{
			$my_score=get_score($cyask_uid);
			if($give_score > $my_score)
			{
				show_message('score_error', '');
				exit;
			}
			else
			{
				update_score($cyask_uid,$give_score,'-'); //¿Û·Ö
			}
		}
		
		$ques_title	= filters_title($_POST['qtitle']);
		$ques_supplement = filters_content($_POST['qsupply']);
        $ques_hidanswer = $_POST['hidanswer'] ? 1 : 0;
        
        $overdue_days = intval($overdue_days);
		$endtime = $timestamp+$overdue_days*86400;

		$sql = "INSERT INTO {$tablepre}question SET sid='$sid',sid1='$sid1',sid2='$sid2',sid3='$sid3',uid='$cyask_uid',username='$cyask_user',title='$ques_title',score='$give_score',asktime='$timestamp',endtime='$endtime',hidanswer='$ques_hidanswer'";
		if($dblink->query($sql))
		{
			$qid = $dblink->insert_id();
		}
		
		$do=$dblink->query("INSERT INTO {$tablepre}question_1 SET qid='$qid',supplement='$ques_supplement'");
		if($do)
		{
	        header("location:signal.php?resultno=101&url=$url");
			exit;
		}
		else
		{
			show_message('ask_error', 'ask.php?word='.$word);
			exit;
		}
	}
	else
	{
		show_message('url_error', './');
		exit;
	}
}
else
{
	$query=$dblink->query("SELECT sid,sort1 FROM {$tablepre}sort WHERE grade=1");
	$count1=$dblink->num_rows($query);
	$class1='';
	$c=1;
	while($row1=$dblink->fetch_array($query))
	{
		$class1.='new Array("'.$row1['sid'].'","'.$row1['sort1'].'")';
		if($c==$count1) $class1.="\n"; else $class1.=",\n";
		$c++;
	}
	
	$query=$dblink->query("SELECT sid,sid1,sort2 FROM {$tablepre}sort WHERE grade=2");
	$count2=$dblink->num_rows($query);
	$class2='';
	$c=1;
	while($row2=$dblink->fetch_array($query))
	{
		$class2.='new Array("'.$row2['sid1'].'","'.$row2['sid'].'","'.$row2['sort2'].'")';
		if($c==$count2) $class2.="\n"; else $class2.=",\n";
		$c++;
	}
	
	$query=$dblink->query("SELECT sid,sid2,sort3 FROM {$tablepre}sort WHERE grade=3");
	$count3=$dblink->num_rows($query);
	$class3='';
	$c=1;
	while($row3=$dblink->fetch_array($query))
	{
		$class3.='new Array("'.$row3['sid2'].'","'.$row3['sid'].'","'.$row3['sort3'].'")';
		if($c==$count3) $class3.="\n"; else $class3.=",\n";
		$c++;
	}
		
	$my_score=get_score($cyask_uid);

}
include template('ask');
?>