<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'search');
require('./include/common.inc.php');
$title=$site_name;

$word=trim($_GET['word']);

$page=$_GET['page'];
if($page<1) $page=1;
$pagerow=20;
$query_count=$dblink->query("select count(*) from {$tablepre}question where title like '%$word%'");
$quescount=$dblink->result($query_count,0); 
$pagecount=ceil($quescount/$pagerow);
if($page>$pagecount) $page=1;
$pagestart=($page-1)*$pagerow;
$query=$dblink->query("select qid,title,status from {$tablepre}question where title like '%$word%' order by qid desc limit $pagestart,$pagerow");
$i=1;
while($row=$dblink->fetch_array($query))
{
	$row['qid']='question.php?qid='.$row['qid'];
	$search_list[$i]=$row;
	$i++;
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
		$pagelinks.='<a href="search.php?word='.$word.'&page='.$i.'">['.$i.']</a>&nbsp;';          
	}
}
$web_path='./';
include template('search');
?>
