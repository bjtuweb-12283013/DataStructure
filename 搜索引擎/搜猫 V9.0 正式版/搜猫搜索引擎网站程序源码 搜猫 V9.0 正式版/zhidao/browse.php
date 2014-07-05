<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'browse');
require('./include/common.inc.php');
$web_path='./';
$sortid=intval($_GET['sortid']);
$type=intval($_GET['type']);
$page=intval($_GET['page']);
if($page<1) $page=1;
$pagerow=25;
$query=$dblink->query("select * from {$tablepre}sort where sid=$sortid");
$sort=$dblink->fetch_array($query);
if($sortid)
{
	switch($sort['grade'])
	{
		case 1:
		$title=$guide=$sort_title=$sort['sort1'];
		$query_menu=$dblink->query("select sid,sort2 as sort,grade from {$tablepre}sort where sid1=$sortid AND grade=2");
		if(!$dblink->num_rows($query_menu))
		{
			$sort_title='';
		}
		
		if($type==1 || $type==2 || $type==3 || $type==7)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid1=$sortid AND status=$type");
			$quescount=$dblink->result($query,0); 
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid1=$sortid AND status=$type order by qid desc limit $pagestart,$pagerow");
		}
		else if($type==5)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where score>40 and sid1=$sortid");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid1=$sortid AND score>40 order by qid desc limit $pagestart,$pagerow");
		}
		else
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid1=$sortid");
			$quescount=$dblink->result($query,0); 
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid1=$sortid order by qid desc limit $pagestart,$pagerow");
		}
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where sid1=$sortid order by clickcount desc limit 10");
		break;

		case 2:
		$title=$sort['sort2'].' - '.$sort['sort1'];
		$sort_title=$sort['sort2'];
		$guide='<a href="browse.php?sortid='.$sort['sid1'].'">'.$sort['sort1'].'</a> &gt;&gt; '.$sort['sort2'];
		$query_menu=$dblink->query("select sid,sort3 as sort,grade from {$tablepre}sort where sid2=$sortid AND grade=3");
		if(!$dblink->num_rows($query_menu))
		{
			$sort_title=$sort['sort1'];
			$query_menu=$dblink->query("select sid,sort2 as sort,grade from {$tablepre}sort where sid1=$sort[sid1] AND grade=2");
		}
		
		if($type==1 || $type==2 || $type==3 || $type==7)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid2=$sortid AND status=$type");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid2=$sortid AND status=$type order by qid desc limit $pagestart,$pagerow");
		}
		elseif($type==5)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid2=$sortid AND score>40");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid2=$sortid AND score>40 order by qid desc limit $pagestart,$pagerow");
		}
		else
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid2=$sortid");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid2=$sortid order by qid desc limit $pagestart,$pagerow");
		}
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where sid2=$sortid order by clickcount desc limit 10");
		break;

		case 3:
		$title=$sort['sort3'].' - '.$sort['sort2'].' - '.$sort['sort1'];
		$guide='<a href="browse.php?sortid='.$sort['sid1'].'">'.$sort['sort1'].'</a> &gt;&gt; <a href="browse.php?sortid='.$sort['sid2'].'">'.$sort['sort2'].'</a> &gt;&gt; '.$sort['sort3'];
	
		$sort_title=$sort['sort2'];
		$query_menu=$dblink->query("select sid,sort3 as sort,grade from {$tablepre}sort where sid2=$sort[sid2] AND grade=3");
	
		if($type==1 || $type==2 || $type==3 || $type==7)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid3=$sortid AND status=$type");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid3=$sortid AND status=$type order by qid desc limit $pagestart,$pagerow");
		}
		elseif($type==5)
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid3=$sortid AND score>40");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid3=$sortid AND score>40 order by qid desc limit $pagestart,$pagerow");
		}
		else
		{
			$query=$dblink->query("select count(*) from {$tablepre}question where sid3=$sortid");
			$quescount=$dblink->result($query,0);
			$pagecount=ceil($quescount/$pagerow);
			if($page>$pagecount) $page=1;
			$pagestart=($page-1)*$pagerow;
			$query=$dblink->query("select * from {$tablepre}question where sid3=$sortid order by qid desc limit $pagestart,$pagerow");
		}
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where sid3=$sortid order by clickcount desc limit 10");
		break;
	}
	
	if($query_menu)
	{
		$i=0;
		while($menu_temp=$dblink->fetch_array($query_menu))
		{
			$menu_temp['id']=$i;
			if($menu_temp['grade']==1)
			{
				$querycount=$dblink->query("select count(*) from {$tablepre}question where sid1=$menu_temp[sid]");
			}
			else if($menu_temp['grade']==2)
			{
				$querycount=$dblink->query("select count(*) from {$tablepre}question where sid2=$menu_temp[sid]");
			}
			else if($menu_temp['grade']==3)
			{
				$querycount=$dblink->query("select count(*) from {$tablepre}question where sid3=$menu_temp[sid]");
			}
			$menu_temp['qcount']= $dblink->result($querycount,0);
			$menu_list[$i] = $menu_temp;
			$i++;
		}
	}
		
	$i=0;
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['url'] = $htmlopen == 1 ? 'question/'.$ques_temp['qid'].'.html' : 'question.php?qid='.$ques_temp['qid'];
		$ques_temp['title']=cut_str($ques_temp['title'],50);
		$ques_temp['asktime']=date("y-m-d",$ques_temp['asktime']);
		$question_list[$i] = $ques_temp;
		
		if($ques_temp['sid3'])
		{
			$query_sort=$dblink->query("select sid,sort3 as sort from {$tablepre}sort where sid=$ques_temp[sid3]");
		}
		elseif($ques_temp['sid2'])
		{
			$query_sort=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid=$ques_temp[sid2]");
		}
		else
		{
			$query_sort=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where sid=$ques_temp[sid1]");
		}
		$sort_array=$dblink->fetch_array($query_sort);
		$question_list[$i]['sid']=$sort_array['sid'];
		$question_list[$i]['sort']=$sort_array['sort'];
		$i++;
	}
	unset($query,$query_sort);
	$i=0;	
	while($temp=$dblink->fetch_array($query_hotques))
	{
		$temp['url'] = $htmlopen == 1 ? 'question/'.$temp['qid'].'.html' : 'question.php?qid='.$temp['qid'];
		$temp['stitle']=cut_str($temp['title'],24);
		$hotques_list[$i] = $temp;
		$i++;
	}
	unset($query_hotques);

	$start = $page-4;
	$end   = $page+5;
	if($start<1) $start=1;
	if($page<5 && $pagecount>=10) $end=10;
	if($end>$pagecount) $end=$pagecount;
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks='';
	for($i=$start; $i<=$end; $i++)
	{
		if($page==$i)
		{
			$pagelinks.=$i.'&nbsp;';
		}
		else
		{
			$pagelinks.='<a href="{$web_path}browse.php?sortid='.$sortid.'type='.$type.'&page='.$i.'">['.$i.']</a>&nbsp;';          
		}
	}

	include template('browse');
	exit;
}
else
{
	if($type>7) $type=0;
	switch($type)
	{ 
		case 1:
		case 2:
		case 3:
		case 7:
		$query=$dblink->query("select count(*) from {$tablepre}question where status=$type");
		$quescount=$dblink->result($query,0);
		$pagecount=ceil($quescount/$pagerow);
		if($page>$pagecount) $page=1;
		$pagestart=($page-1)*$pagerow;
		$query=$dblink->query("select * from {$tablepre}question where status=$type order by qid desc limit $pagestart,$pagerow");
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where status=$type order by clickcount desc limit 10");
		break;
	
		case 5:
		$query=$dblink->query("select count(*) from {$tablepre}question where score>40");
		$quescount=$dblink->result($query,0);
		$pagecount=ceil($quescount/$pagerow);
		if($page>$pagecount) $page=1;
		$pagestart=($page-1)*$pagerow;
		$query=$dblink->query("select * from {$tablepre}question where score>40 order by qid desc limit $pagestart,$pagerow");
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where score>40 order by clickcount desc limit 10");
		break;
	
		case 6:
		$query=$dblink->query("select count(*) from {$tablepre}question where introtime>0");
		$quescount=$dblink->result($query,0);
		$pagecount=ceil($quescount/$pagerow);
		if($page>$pagecount) $page=1;
		$pagestart=($page-1)*$pagerow;
		$query=$dblink->query("select * from {$tablepre}question where introtime<>0 order by qid desc limit $pagestart,$pagerow");
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question where introtime<>0 order by clickcount desc limit 10");
		break;
		
		default:
		$query=$dblink->query("select count(*) from {$tablepre}question");
		$quescount=$dblink->result($query,0);
		$pagecount=ceil($quescount/$pagerow);
		if($page>$pagecount) $page=1;
		$pagestart=($page-1)*$pagerow;
		$query=$dblink->query("select * from {$tablepre}question order by qid desc limit $pagestart,$pagerow");
		$query_hotques=$dblink->query("select qid,title from {$tablepre}question order by clickcount desc limit 10");
	}
	$title=$site_name.' - powered by cyask.com';
	$i=1;
	while($ques_temp=$dblink->fetch_array($query))
	{
		$ques_temp['url'] = $htmlopen == 1 ? 'question/'.$ques_temp['qid'].'.html' : 'question.php?qid='.$ques_temp['qid'];
		$ques_temp['title']=cut_str($ques_temp['title'],50);
		$ques_temp['asktime']=date("y-m-d",$ques_temp['asktime']);
		if($ques_temp['sid4'])
		{
			$query_sort=$dblink->query("select sid,sort4 as sort from {$tablepre}sort where sid=$ques_temp[sid4]");
		}
		elseif($ques_temp['sid3'])
		{
			$query_sort=$dblink->query("select sid,sort3 as sort from {$tablepre}sort where sid=$ques_temp[sid3]");
		}
		elseif($ques_temp['sid2'])
		{
			$query_sort=$dblink->query("select sid,sort2 as sort from {$tablepre}sort where sid=$ques_temp[sid2]");
		}
		else
		{
			$query_sort=$dblink->query("select sid,sort1 as sort from {$tablepre}sort where sid=$ques_temp[sid1]");
		}
		$sort_array=$dblink->fetch_array($query_sort);
		$ques_temp['sid']=$sort_array['sid'];
		$ques_temp['sort']=$sort_array['sort'];
		$ques_list[$i] = $ques_temp;
		$i++;
	}
	unset($query,$query_sort,$sort_array['sid'],$sort_array['sort']);
	$i=1;
	while($temp=$dblink->fetch_array($query_hotques))
	{
		$temp['stitle']=cut_str($temp['title'],24);
		$hotques_list[$i] = $temp;
		$i++;
	}
	unset($query_hotques);

	$start = $page-4;
	$end   = $page+5;
	if($start<1) $start=1;
	if($page<5 && $pagecount>=10) $end=10;
	if($end>$pagecount) $end=$pagecount;
	$page_front	=$page-1;
	$page_next	=$page+1;
	$pagelinks='';
	for($i=$start; $i<=$end; $i++)
	{
		if($page==$i)
		{
			$pagelinks.=$i.'&nbsp;';
		}
		else
		{
			$pagelinks.='<a href="./browse.php?type='.$type.'&page='.$i.'">['.$i.']</a>&nbsp;';          
		}
	}

	include template('browse_more');
}
?>