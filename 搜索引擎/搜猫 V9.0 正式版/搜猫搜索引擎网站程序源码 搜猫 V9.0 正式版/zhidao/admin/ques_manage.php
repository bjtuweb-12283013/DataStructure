<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/

if(!defined('IN_CYASK'))
{
        exit('Access Denied');
}

if($admin_action=='ques_sort')
{
	admin_header();
	$sid=intval($_GET['sid']);
	if($grade==1)
	{
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td><?php echo $lang['menu_sort_ques'];?></td></tr>
	<?php
	$query=$dblink->query("SELECT sid,sort1 AS sort,orderid FROM {$tablepre}sort WHERE grade=1 ORDER BY orderid asc");
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#f8f8f8"><td><b><?php echo $row['sort'];?></b>
	<a href="admin.php?admin_action=ques_list&grade=1&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['ques_list'];?></font>]</a>
	<a href="admin.php?admin_action=ques_sort&grade=2&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['menu_children_sort'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#F8F8F8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#F8F8F8" height=50><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
</td></tr>
</table>
<?php
	}
	elseif($grade==2)
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$sort_row=$dblink->fetch_array($query);
		$query=$dblink->query("SELECT sid,sort2 AS sort,orderid FROM {$tablepre}sort WHERE grade=2 AND sid1=$sid ORDER BY orderid asc");
	?>
	<br><br>
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td><?php echo $lang['menu_sort_ques'];?></td></tr>
	<tr bgcolor="#ffffff"><td>/<strong><?php echo $sort_row['sort1'];?></strong>/ &nbsp;<a href="admin.php?admin_action=ques_sort">[<?php echo $lang['menu_parent_sort'];?>]</a></td></tr>
	<?php
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#ffffff"><td><b><?php echo $row[sort];?></b>
	<a href="admin.php?admin_action=ques_list&grade=2&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['ques_list'];?></font>]</a>
	<a href="admin.php?admin_action=ques_sort&grade=3&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['menu_children_sort'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#f8f8f8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#ffffff" height=50><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
</td></tr>
</table>
<?php
	}
	elseif($grade==3)
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid='$_GET[sid]'");
		$sort_row=$dblink->fetch_array($query);
		$query=$dblink->query("SELECT sid,sort3 AS sort,orderid FROM {$tablepre}sort WHERE grade='3' AND sid2='$_GET[sid]' ORDER BY orderid asc");
	?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td><?php echo $lang['menu_sort_ques'];?></td></tr>
	<tr bgcolor="#ffffff"><td>/<strong><?php echo $sort_row['sort1'];?></strong>/<strong><?php echo $sort_row['sort2'];?></strong>/ &nbsp;<a href="admin.php?admin_action=ques_sort&grade=2&sid=<?php echo $sort_row['sid1'];?>">[<?php echo $lang['menu_parent_sort'];?>]</a></td></tr>
	<?php
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#FFFFFF"><td><b><?php echo $row['sort'];?></b>
	<a href="admin.php?admin_action=ques_list&grade=3&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['ques_list'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#F8F8F8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#ffffff" height="50"><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
</td></tr>
</table>
<?php
	}
	else
	{
		exit("ques_sort error");
	}
	admin_footer();
	exit();
}
elseif($admin_action=='ques_list')
{
	$sid=intval($_GET['sid']);
	if(!$page) $page=1;
	$pagerow=20;
	$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
	$sort_row=$dblink->fetch_array($query);
	
	if($sort_row['grade']==1)
	{
		$sort_path=$sort_row['sort1'].'&nbsp;&nbsp;<a href="admin.php?admin_action=ques_sort">['.$lang['menu_parent_sort'].']</a>';
		$sort_sid=intval($sort_row['sid']);
		$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE sid1=$sort_sid"); 
		$qcount=$dblink->result($query,0);
		$pagecount=ceil($qcount/$pagerow);
		if ($page>$pagecount) $page=1;
		$start=($page-1)*$pagerow;
		$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE sid1=$sort_sid ORDER BY asktime desc limit $start,$pagerow");
	}
	elseif($sort_row['grade']==2)
	{
		$sort_path=$sort_row['sort1'].' -> '.$sort_row['sort2'].'&nbsp;&nbsp;<a href="admin.php?admin_action=ques_sort&grade=2&sid='.$sort_row[sid1].'">['.$lang['menu_parent_sort'].']</a>';
		$sort_sid=intval($sort_row['sid']);
		$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE sid2=$sort_sid"); 
		$qcount=$dblink->result($query,0);
		$pagecount=ceil($qcount/$pagerow);
		if ($page>$pagecount) $page=1;
		$start=($page-1)*$pagerow;
		$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE sid2=$sort_sid ORDER BY asktime desc limit $start,$pagerow");
	
	}
	elseif($sort_row['grade']==3)
	{
		$sort_path=$sort_row['sort1'].' -> '.$sort_row['sort2'].' -> '.$sort_row[sort3].'&nbsp;&nbsp;<a href="admin.php?admin_action=ques_sort&grade=3&sid='.$sort_row[sid2].'">['.$lang['menu_parent_sort'].']</a>';
		$sort_sid=intval($sort_row['sid']);
		$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE sid3=$sort_sid"); 
		$qcount=$dblink->result($query,0);
		$pagecount=ceil($qcount/$pagerow);
		if ($page>$pagecount) $page=1;
		$start=($page-1)*$pagerow;
		$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE sid3=$sort_sid ORDER BY asktime desc limit $start,$pagerow");
	}
	else
	{
		exit("ques_grade error");
	}
	admin_header();
?>
<script type="text/javascript">
function disQstate(s)
{ 
	switch (s)
	{
		case 1:var op="<font color=#8b0000><?php echo $lang['nosolve'];?></font>";break;
		case 2:var op="<font color=#006400><?php echo $lang['solve'];?></font>";break;
		case 3:var op="<font color=#0000ff><?php echo $lang['voting'];?></font>";break;
		case 4:var op="<font color=#a9a9a9><?php echo $lang['closed'];?></font>";break;
		default: var op="<?php echo $lang['unknown'];?>";
	}
	document.write(op);
}
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_sort_ques'];?></td></tr>
	<tr bgcolor="#ffffff"><td><?php echo $sort_path;?></td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=330 height=26 align=center><?php echo $lang['subject'];?></td>
		<td width=100 align=center><?php echo $lang['asktime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=50 align=center><?php echo $lang['answer'];?></td>
		<td width=50 align=center><?php echo $lang['browse'];?></td>
		<td width=60 align=center><?php echo $lang['status'];?></td>
		<td width=50 align=center><?php echo $lang['intro'];?></td>
		<td width=45 align=center><?php echo $lang['edit'];?></td>
		<td width=45 align=center><?php echo $lang['delete'];?></td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],54);
			$introtag = $row['introtime'] ? '<font color="red">'.$lang['intro_yes'].'</font>' : $lang['intro_no'];
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width=330 height=26 align=left><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=100 align=center><?php echo date("n-j H:i",$row['asktime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=50 align=center><?php echo $row['answercount']?></td>
		<td width=50 align=center><?php echo $row['clickcount']?></td>
		<td width=60 align=center><script type="text/javascript">disQstate(<?php echo $row['status'];?>);</script></td>
		<td width=50 align=center><a href="admin.php?admin_action=ques_top&qid=<?php echo $row['qid'];?>"><?php echo $introtag;?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_edit&qid=<?php echo $row['qid'];?>"><?php echo $lang['edit'];?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>" onclick="return confirm('<?php echo $msglang['del_alert'];?>');"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="10" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=8 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="10" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&sid=<?php echo $sid;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color="red">'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&sid='.$sid.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&sid=<?php echo $sid;?>&page=<?php echo $pagecount;?>"><?php echo $lang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</form>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_nosolve')
{
	if(!$page) $page=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE status=1"); 
	$qcount=$dblink->result($query,0);
	$pagecount=ceil($qcount/$pagerow);
	if ($page>$pagecount) $page=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE status='1' ORDER BY asktime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function disQstate(s)
{ 
	switch (s)
	{
		case 1:var op="<font color=#8b0000><?php echo $lang['nosolve'];?></font>";break;
		case 2:var op="<font color=#006400><?php echo $lang['solve'];?></font>";break;
		case 3:var op="<font color=#0000ff><?php echo $lang['voting'];?></font>";break;
		case 4:var op="<font color=#a9a9a9><?php echo $lang['closed'];?></font>";break;
		default: var op="<?php echo $lang['unknown'];?>";
	}
	document.write(op);
}
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}

</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_nosolve_ques'];?> &nbsp;(<?php echo $qcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=330 height=26 align=center><?php echo $lang['subject'];?></td>
		<td width=100 align=center><?php echo $lang['asktime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=50 align=center><?php echo $lang['answer'];?></td>
		<td width=50 align=center><?php echo $lang['browse'];?></td>
		<td width=60 align=center><?php echo $lang['status'];?></td>
		<td width=50 align=center><?php echo $lang['intro'];?></td>
		<td width=45 align=center><?php echo $lang['edit'];?></td>
		<td width=45 align=center><?php echo $lang['delete'];?></td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],54);
			$introtag = $row['introtime'] ? '<font color="red">'.$lang['intro_yes'].'</font>' : $lang['intro_no'];
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width="330" height="26" align="left"><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=100 align=center><?php echo date("y-n-j H:i",$row['asktime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=50 align=center><?php echo $row['answercount']?></td>
		<td width=50 align=center><?php echo $row['clickcount']?></td>
		<td width=60 align=center><script type="text/javascript">disQstate(<?php echo $row['status'];?>);</script></td>
		<td width=50 align=center><a href="admin.php?admin_action=ques_top&qid=<?php echo $row['qid'];?>"><?php echo $introtag;?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_edit&qid=<?php echo $row['qid'];?>"><?php echo $lang['edit'];?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>" onclick="return confirm('<?php echo $msglang['del_alert'];?>');"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="10" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=8 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="10" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color=red>'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>"><?php echo $msglang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</from>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_solve')
{
	if(!$page) $page=1;
	$pagerow=20;

	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE status=2"); 
	$qcount=$dblink->result($query,0);
	$pagecount=ceil($qcount/$pagerow);
	if ($page>$pagecount) $page=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE status=2 ORDER BY asktime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function disQstate(s)
{ 
	switch (s)
	{
		case 1:var op="<font color=#8b0000><?php echo $lang['nosolve'];?></font>";break;
		case 2:var op="<font color=#006400><?php echo $lang['solve'];?></font>";break;
		case 3:var op="<font color=#0000ff><?php echo $lang['voting'];?></font>";break;
		case 4:var op="<font color=#a9a9a9><?php echo $lang['closed'];?></font>";break;
		default: var op="<?php echo $lang['unknown'];?>";
	}
	document.write(op);
}
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_solve_ques'];?> &nbsp;(<?php echo $qcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=230 height=26 align=center><?php echo $lang['subject'];?></td>
		<td width=100 align=center><?php echo $lang['asktime'];?></td>
		<td width=100 align=center><?php echo $lang['endtime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=50 align=center><?php echo $lang['answer'];?></td>
		<td width=60 align=center><?php echo $lang['browse'];?></td>
		<td width=60 align=center><?php echo $lang['status'];?></td>
		<td width=45 align=center><?php echo $lang['intro'];?></td>
		<td width=45 align=center><?php echo $lang['delete'];?></td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],54);
			$introtag = $row['introtime'] ? '<font color="red">'.$lang['intro_yes'].'</font>' : $lang['intro_no'];
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width=230 height=26 align=left><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=100 align=center><?php echo date("n-j H:i",$row['asktime'])?></td>
		<td width=100 align=center><?php echo date("n-j H:i",$row['endtime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=50 align=center><?php echo $row['answercount']?></td>
		<td width=60 align=center><?php echo $row['clickcount']?></td>
		<td width=60 align=center><script type="text/javascript">disQstate(<?php echo $row['status'];?>);</script></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_top&qid=<?php echo $row['qid'];?>"><?php echo $introtag;?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>" onclick="return confirm('<?php echo $msglang['del_alert'];?>');"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="11" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=8 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="10" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color="red">'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>"><?php echo $lang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</from>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_vote')
{
	if(!$page) $page=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE status=3"); 
	$qcount=$dblink->result($query,0);
	$pagecount=ceil($qcount/$pagerow);
	if ($page>$pagecount) $page=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE status=3 ORDER BY asktime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height=22><?php echo $lang['menu_vote_ques'];?> &nbsp;(<?php echo $qcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=330 height=26 align=center><?php echo $lang['subject'];?></td>
		<td width=120 align=center><?php echo $lang['asktime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=60 align=center><?php echo $lang['answer'];?></td>
		<td width=60 align=center><?php echo $lang['browse'];?></td>
		<td width=45 align=center><?php echo $lang['edit'];?></td>
		<td width=45 align=center><?php echo $lang['delete'];?></td>
		
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],54);
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width=330 height=26 align=left><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=120 align=center><?php echo date("y-n-j H:i",$row['asktime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=60 align=center><?php echo $row['answercount']?></td>
		<td width=60 align=center><?php echo $row['clickcount']?></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_edit&qid=<?php echo $row['qid'];?>"><?php echo $lang['edit'];?></a></td>
		<td width=45 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>" onclick="return confirm('<?php echo $msglang['del_alert'];?>');"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="8" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=6 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="8" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color=red>'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>"><?php echo $lang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</from>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_intro')
{
	if(!$page) $page=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE introtime >0"); 
	$qcount=$dblink->result($query,0);
	$pagecount=ceil($qcount/$pagerow);
	if ($page>$pagecount) $page=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE introtime >0 ORDER BY introtime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function disQstate(s)
{ 
	switch (s)
	{
		case 1:var op="<font color=#8b0000><?php echo $lang['nosolve'];?></font>";break;
		case 2:var op="<font color=#006400><?php echo $lang['solve'];?></font>";break;
		case 3:var op="<font color=#0000ff><?php echo $lang['voting'];?></font>";break;
		case 4:var op="<font color=#a9a9a9><?php echo $lang['closed'];?></font>";break;
		default: var op="<?php echo $lang['unknown'];?>";
	}
	document.write(op);
}
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_intro_ques'];?> &nbsp;(<?php echo $qcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=330 height=26 align=center><?php echo $lang['subject'];?></td>
		<td width=120 align=center><?php echo $lang['asktime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=60 align=center><?php echo $lang['answer'];?></td>
		<td width=60 align=center><?php echo $lang['browse'];?></td>
		<td width=60 align=center><?php echo $lang['status'];?></td>
		<td width=50 align=center><?php echo $lang['intro'];?></td>
		<td width=50 align=center><?php echo $lang['delete'];?></td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],54);
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width=330 height=26 align=left><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=120 align=center><?php echo date("y-n-j H:i",$row['asktime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=60 align=center><?php echo $row['answercount']?></td>
		<td width=60 align=center><?php echo $row['clickcount']?></td>
		<td width=60 align=center><script language=javascript>disQstate(<?php echo $row['status'];?>);</script></td>
		<td width=50 align=center><a href="admin.php?admin_action=ques_top&qid=<?php echo $row['qid'];?>"><?php echo $lang['cancel'];?></a></td>
		<td width=50 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>" onclick="return confirm('<?php echo $msglang['del_alert'];?>');"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="9" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=7 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="9" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color=red>'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>"><?php echo $lang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</from>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_close')
{
	if(!$page) $page=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}question WHERE status=4"); 
	$qcount=$dblink->result($query,0);
	$pagecount=ceil($qcount/$pagerow);
	if ($page>$pagecount) $page=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}question WHERE status=4 ORDER BY asktime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function checkDelAll(f)
{
	if( !confirm("<?php echo $msglang['del_alert'];?>")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_close_ques'];?> &nbsp;(<?php echo $qcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Qform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width=20 align=center>&nbsp;</td>
		<td width=390 height="26" align="center"><?php echo $lang['subject'];?></td>
		<td width=100 align=center><?php echo $lang['asktime'];?></td>
		<td width=50 align=center><?php echo $lang['reward'];?></td>
		<td width=60 align=center><?php echo $lang['answer'];?></td>
		<td width=60 align=center><?php echo $lang['browse'];?></td>
		<td width=50 align=center><?php echo $lang['delete'];?></td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$stitle=cut_str($row['title'],60);
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=qid[] value="<?php echo $row['qid'];?>" /></td>
		<td width=390 height="26" align="left"><a href="question.php?qid=<?php echo $row['qid'];?>" title="<?php echo $row['title'];?>" target="_blank"><?php echo $stitle;?></a></td>
		<td width=100 align=center><?php echo date("n-j H:i",$row['asktime'])?></td>
		<td width=50 align=center><?php echo $row['score']?></td>
		<td width=60 align=center><?php echo $row['answercount']?></td>
		<td width=60 align=center><?php echo $row['clickcount']?></td>
		<td width=50 align=center><a href="admin.php?admin_action=ques_del&qid=<?php echo $row['qid'];?>"><?php echo $lang['del'];?></a></td>
		</tr>
		<?php
		}
		if(!$qcount)
		{
		?>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="7" align="center"><?php echo $msglang['no_question'];?></td></tr>
		<?php
		}
		else
		{
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=qid_all value="all" onclick="checkAll(this, 'qid[]');" /></td>
		<td colspan=5 align="left"><?php echo $lang['select_all'];?></td>
		<td width=50 align=center>
		<input type="hidden" name="admin_action" value="ques_del" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td></tr>
		<tr bgcolor="#F8F8F8" height="30">
		<td colspan="7" align="center">
		<font color="#000080"><?php echo $page;?>/<?php echo $pagecount;?></font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1"><?php echo $lang['first_page'];?></a>
       <?php
		if($pagecount>1)
		{
			$start = floor($page/10)*10;
			$end = $start+9;
			if($start<1)
			{
				$start=1;
			}
			if($end>$pagecount)
			{
				$end=$pagecount;
			}
			for($i=$start; $i<=$end; $i++)
			{
				if($page==$i)
				{
					echo '&nbsp;<font color=red>'.$i.'</font>';
				}
				else
				{
					echo '<a href="admin.php?admin_action='.$admin_action.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>"><?php echo $lang['tail_page'];?></a>
		<?php
		} 
		?>
		</td></tr>
		</from>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
}
elseif($admin_action=='ques_edit')
{
	if(isset($_POST['edit_submit']))
	{
		$cid=intval($_POST['cid']);
		$query=$dblink->query("SELECT * FROM {$tablepre}sort where sid='$cid'");
		$sids=$dblink->fetch_array($query);
		if($sids['grade']==1)
		{
			$sid1=$sids['sid'];
			$sid2=0;
			$sid3=0;
		}
		else if($sids['grade']==2)
		{
			$sid1=$sids['sid1'];
			$sid2=$sids['sid'];
			$sid3=0;
		}
		else if($sids['grade']==3)
		{
			$sid1=$sids['sid1'];
			$sid2=$sids['sid2'];
			$sid3=$sids['sid'];
		}
		
		$qid=intval($_POST['qid']);
		$title=filters_title($_POST['title']);
		$supplement=filters_content($_POST['supplement']);
		$dblink->query("UPDATE {$tablepre}question SET sid='$cid',sid1='$sid1',sid2='$sid2',sid3='$sid3',title='$title' WHERE qid=$qid");
		$dblink->query("UPDATE {$tablepre}question_1 SET supplement='$supplement' WHERE qid=$qid");

		$referer=$_POST['backurl'];
		$referer=empty($referer) ? 'admin.php?admin_action=ques_sort' : $referer;
		header("location:$referer");
	}
	else
	{
		$qid=intval($_GET['qid']);
		$query=$dblink->query("SELECT qid,sid,sid1,sid2,sid3,title FROM {$tablepre}question WHERE qid=$qid");
		$row=$dblink->fetch_array($query);
		$query_c=$dblink->query("SELECT supplement FROM {$tablepre}question_1 WHERE qid=$qid");
		$row_c=$dblink->fetch_array($query_c);
		$row=array_merge($row,$row_c);
		$sid=$row['sid'];

		if($sid)
		{
			$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
			$sort=$dblink->fetch_array($query);
			
			if($sort['grade']==1)
			{
				$sort_list=$sort['sort1'];
			}
			else if($sort['grade']==2)
			{
				$sort_list=$sort['sort1'].' -&gt; '.$sort['sort2'];
			}
			else if($sort['grade']==3)
			{
				$sort_list=$sort['sort1'].' -&gt; '.$sort['sort2'].' -&gt; '.$sort['sort3'];
			}
			
		}
		$row['supplement']=filters_outcontent($row['supplement']);
		$row['supplement']=htmlspecialchars($row['supplement']);
		admin_header();
?>
<script type="text/javascript">
function gcv(f)
{  
	var aa = document.getElementsByName("ra");
	for(var  i=0;  i<aa.length; i++)  
	{
		if(aa[i].checked)
        {
			document.editForm.cid.value = aa[i].value;
        }
	}
}
</script>
<table cellspacing="1" cellpadding="0" width="760" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="22"><?php echo $lang['menu_edit_ques'];?></td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name=editForm action="admin.php" method="post" onsubmit="return gcv(this)">
		<tr bgcolor="#f8f8f8">
		<td width="100" align="right"><?php echo $lang['belong_to_sort'];?>:&nbsp;&nbsp;</td>
		<td width="600" height="30" align="left">
		<span id="classid">
		<input name="ra" type="radio" checked value="<?php echo $sid;?>" /><?php echo $sort_list;?>
		</span>
		&nbsp;&nbsp;<a href="javascript:void(0)" onClick=window.open("selectsort.php","","width=450,height=350");>[ÐÞ¸Ä]</a>
		</td></tr>
		
		<tr bgcolor="#f8f8f8">
		<td width="100" align="right"><?php echo $lang['subject'];?>:&nbsp;&nbsp;</td>
		<td width="600" height="30" align="left">
		<input type="text" name="title" size="80" maxlength="50" value="<?php echo $row['title'];?>" />
		</td></tr>
	
		<tr bgcolor="#f8f8f8">
		<td width="100" align="right"><?php echo $lang['menu_supply_ques'];?>:&nbsp;&nbsp;</td>
		<td width="600" height="26" align="left">
		<input type="hidden" name="supplement" value="<?php echo $row['supplement'];?>" />
		<script type="text/javascript" src="cyaskeditor/CyaskEditor.js"></script>
		<script type="text/javascript">
<!--
var editor = new CyaskEditor("editor");
editor.hiddenName = "supplement";
editor.editorType = "simple";
editor.editorWidth = "600px";
editor.editorHeight = "300px";
editor.show();
function cyaskeditorsubmit(){editor.data();}
-->
	</script>
		</td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="100" align="center">&nbsp;</td>
		<td width="600" height="26" align="left">
		 <input type="hidden" name="admin_action" value="ques_edit" />
		 <input type="hidden" name="qid" value="<?php echo $row['qid'];?>" />
		 <input type="hidden" name="cid" value="0" />
		 <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER'];?>" />
		 <input type="submit" name="edit_submit" value="<?php echo $lang['edit'];?>" onclick="cyaskeditorsubmit()" />&nbsp;&nbsp;
		 <input type="button" name="submit2" value="<?php echo $lang['cancel'];?>" onclick="history.back();" />
		 </td>
		</tr>
		  </form>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
		admin_footer();
		exit();
	}
}
elseif($admin_action=='ques_top')
{
	$qid=intval($_GET['qid']);
	$sid=intval($_GET['sid']);
	$page=intval($_GET['page']);
	$query=$dblink->query("SELECT introtime FROM {$tablepre}question where qid=$qid");
	$introtime=$dblink->result($query,0);
	$introtime = $introtime ? 0 : time();
	$dblink->query("UPDATE {$tablepre}question SET introtime='$introtime' where qid=$qid");
	
	$referer=$_SERVER['HTTP_REFERER'];
	$referer=empty($referer) ? 'admin.php?admin_action=ques_sort' : $referer;
	header("location:$referer");
}
elseif($admin_action=='ques_del')
{
	$qid_array=array();
	if(is_array($_POST['qid']))
	{
		$qid_array=$_POST['qid'];
	}
	else
	{
		$qid_array[]=intval($_GET['qid']);
	}
	
	foreach($qid_array as $qid)
	{
		if($qid)
		{
			$query = $dblink->query("SELECT tableid FROM {$tablepre}question where qid=$qid");
			$tableid = $dblink->result($query,0);
			$question_table = $tablepre.'question_'.$tableid;
			
			$dblink->query("DELETE FROM {$tablepre}question where qid=$qid");
			$dblink->query("DELETE FROM $question_table where qid=$qid");
			$dblink->query("DELETE FROM {$tablepre}answer where qid=$qid");
		}
	}

	$referer=$_SERVER['HTTP_REFERER'];
	$referer=empty($referer) ? 'admin.php?admin_action=ques_sort' : $referer;
	header("location:$referer");
	
}
else
{
	echo 'ques_manage error';
}
?>