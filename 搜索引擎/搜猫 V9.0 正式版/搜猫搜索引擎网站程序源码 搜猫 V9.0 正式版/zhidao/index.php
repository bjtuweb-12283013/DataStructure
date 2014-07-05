<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'index');
require_once ('include/common.inc.php');
	
$title=$site_name.' - powered by cyask.com';
$query=$dblink->query("select count(*) from {$tablepre}question where status=2");
$solve_ques_count=$dblink->result($query,0);

$query=$dblink->query("select count(*) from {$tablepre}question where status in(1,3)");
$nosolve_ques_count=$dblink->result($query,0);

$count_show_sort1=intval($count_show_sort1);
$count_show_sort2=intval($count_show_sort2);
$count_show_intro=intval($count_show_intro);
$count_show_nosolve=intval($count_show_nosolve);
$count_show_solve=intval($count_show_solve);

$query=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where grade=1 order by orderid asc,sid asc limit $count_show_sort1");
$i=0;
$sort1_list=array();
$sort2_list=array();
while($sort1_temp=$dblink->fetch_array($query))
{
	$sort1_temp['id']= $i;
	$querycount=$dblink->query("select count(*) from {$tablepre}question where sid1=$sort1_temp[sid]");
	$sort1_temp['qcount']= $dblink->result($querycount,0);
	$sort1_list[$i]  = $sort1_temp;
	$querytemp=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid1=$sort1_temp[sid] and grade=2 order by orderid asc limit $count_show_sort2");
	$j=1;
	while($sort2_temp=$dblink->fetch_array($querytemp))
	{
		$sort2_temp['id']= $j;
		$sort2_list[$i][$j]=$sort2_temp;
		$j++;
	}
	$i++;
}

$query_intro=$dblink->query("select qid,title,sid1,sid2,sid3 from {$tablepre}question where introtime>0 order by introtime desc limit $count_show_intro");
$intro_ques=array();
while($intro=$dblink->fetch_array($query_intro))
{
	$intro['url'] = $htmlopen == 1 ? 'question/'.$intro['qid'].'.html' : 'question.php?qid='.$intro['qid'];
	
	$intro['title']=cut_str($intro['title'],60);
	
	if($intro['sid3'])
	{
		$query_sort=$dblink->query("select sid,sort3 as sort from {$tablepre}sort where sid=$intro[sid3]");
	}
	else if($intro['sid2'])
	{
		$query_sort=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid=$intro[sid2]");
	}
	else
	{
		$query_sort=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where sid=$intro[sid1]");
	}
	$sort=$dblink->fetch_array($query_sort);
	$intro_ques[] = array_merge($intro,$sort);
}

$query=$dblink->query("select qid,title,sid1,sid2,sid3 from {$tablepre}question where status in(1,3) order by qid desc limit $count_show_nosolve");
$nosolve_ques=array();
while($nosolve=$dblink->fetch_array($query))
{
	$nosolve['url'] = $htmlopen == 1 ? 'question/'.$nosolve['qid'].'.html' : 'question.php?qid='.$nosolve['qid'];
	
	$nosolve['title']=cut_str($nosolve['title'],58);
	
	if($nosolve['sid3'])
	{
		$query_sort=$dblink->query("select sid,sort3 as sort from {$tablepre}sort where sid=$nosolve[sid3]");
	}
	elseif($nosolve['sid2'])
	{
		$query_sort=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid=$nosolve[sid2]");
	}
	else
	{
		$query_sort=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where sid=$nosolve[sid1]");
	}
	$sort=$dblink->fetch_array($query_sort);
	$nosolve_ques[] = array_merge($nosolve,$sort);
}

$query=$dblink->query("select qid,title,sid1,sid2,sid3 from {$tablepre}question where status=2 order by qid desc limit $count_show_solve");
$solve_ques=array();
while($solve=$dblink->fetch_array($query))
{
	$solve['url'] = $htmlopen == 1 ? 'question/'.$solve['qid'].'.html' : 'question.php?qid='.$solve['qid'];
	
	$solve['title']=cut_str($solve['title'],58);
	
	if($solve['sid3'])
	{
		$query_sort=$dblink->query("select sid,sort3 as sort from {$tablepre}sort where sid=$solve[sid3]");
	}
	elseif($solve['sid2'])
	{
		$query_sort=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid=$solve[sid2]");
	}
	else
	{
		$query_sort=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where sid=$solve[sid1]");
	}
	$sort=$dblink->fetch_array($query_sort);
	$solve_ques[] = array_merge($solve,$sort);
}

$query=$dblink->query("select id,title,url from {$tablepre}notice order by orderid asc limit $count_show_note");
$notice_list=array();
while($notice=$dblink->fetch_array($query))
{
	$notice['id']= empty($notice['url']) ? 'notice.php?id='.$notice['id'] : $notice['url'];
	$notice['stitle']=cut_str($notice['title'],24);
	$notice_list[]=$notice;
}

$query=$dblink->query("SELECT uid,username,allscore FROM {$tablepre}member WHERE adminid=5 ORDER BY allscore desc limit 6");
$scorelist=array();
while($temp=$dblink->fetch_array($query))
{
	$scorelist[]=$temp;
}

$lastweek=get_weeks()-1;
$query=$dblink->query("SELECT uid,sum(score) as wscore FROM {$tablepre}score WHERE week=$lastweek GROUP BY uid ORDER BY wscore desc limit 6");
$weeklist=array();
while($temp=$dblink->fetch_array($query))
{
	$query1=$dblink->query("SELECT username FROM {$tablepre}member WHERE uid=$temp[uid]");
	$temp['username']=$dblink->result($query1,0,0);
	$weeklist[]=$temp;
}

$mtime = explode(' ', microtime());
$cyask_endtime = $mtime[1] + $mtime[0];
$runtime = $cyask_endtime - $cyask_starttime;

unset($query);
include template('index');
?>