<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'scorelist');
require('./include/common.inc.php');
$web_path='./';

$stype=empty($_GET['stype']) ? 'all' : $_GET['stype'];
$page=intval($_GET['page']);
if($page<1) $page=1;
$pagerow=25;

switch($stype)
{
	case 'week':
	$lastweek=get_weeks()-1;
	$query=$dblink->query("select uid from {$tablepre}score where week=$lastweek group by uid");
	$membercount=$dblink->num_rows($query);
	$pagecount=ceil($membercount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("select uid,sum(score) as newscore from {$tablepre}score where week=$lastweek group by uid order by newscore desc limit $pagestart,$pagerow");
	$i=0;
	while($temp=$dblink->fetch_array($query))
	{
		$temp['orderid'] = $i+1;
		$query1 = $dblink->query("select username,gender,lastlogin from {$tablepre}member where uid=$temp[uid]");
		$temp1 = $dblink->fetch_array($query1);
		$temp1['lastlogin']=date("Y-m-d",$temp1['lastlogin']);
		
		$score_list[$i] = array_merge($temp,$temp1);
		$i++;
	}
	break;
	
	case 'month':
	$year=intval(date("Y"));
	$month=date("n")-1;
	$month=intval($month);
	if(!$month)
	{
		$year=$year-1;
		$month=12;
	}
	$lastmonth=intval($year.$month);
	
	$query=$dblink->query("select count(uid) from {$tablepre}score where month=$lastmonth group by uid");
	$membercount=$dblink->result($query,0);
	$pagecount=ceil($membercount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("select uid,sum(score) as newscore from {$tablepre}score where month=$lastmonth group by uid order by newscore desc limit $pagestart,$pagerow");
	$i=0;
	while($temp=$dblink->fetch_array($query))
	{
		$temp['orderid']=$i+1;
		$query1=$dblink->query("select username,gender,lastlogin from {$tablepre}member where uid=$temp[uid]");
		$temp1=$dblink->fetch_array($query1);
		$temp1['lastlogin']=date("Y-m-d",$temp1['lastlogin']);
		$score_list[$i] = array_merge($temp,$temp1);
		$i++;
	}
	break;

	default:
	$query=$dblink->query("select count(*) from {$tablepre}member where adminid=5");
	$membercount=$dblink->result($query,0);
	$pagecount=ceil($membercount/$pagerow);
	if($page>$pagecount) $page=1;
	$pagestart=($page-1)*$pagerow;
	$query=$dblink->query("select uid,username,gender,allscore as newscore,lastlogin from {$tablepre}member where adminid=5 order by allscore desc limit $pagestart,$pagerow");
	$i=0;
	while($temp=$dblink->fetch_array($query))
	{
		$temp['orderid']=$i+1;
		$temp['lastlogin']=date("Y-m-d",$temp['lastlogin']);
		$score_list[$i] = $temp;
		$i++;
	}
}

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
		$pagelinks.='<a href="./scorelist.php?stype='.$stype.'&page='.$i.'">['.$i.']</a>&nbsp;';          
	}
}

$title=$site_name;
include template('scorelist');
?>