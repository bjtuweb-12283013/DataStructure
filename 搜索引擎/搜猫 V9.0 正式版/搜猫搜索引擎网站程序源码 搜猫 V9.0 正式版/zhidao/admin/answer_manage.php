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
if(!$admin_login)
{
	header("location:admin.php?admin_action=login&backaction=$admin_action");
}
if($admin_action=='ques_answer')
{
	if(!$_GET['page']) $_GET['page']=1;
	$pagerow=20;
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer"); 
	$acount=$dblink->result($query,0);
	$pagecount=ceil($acount/$pagerow);
	if ($_GET['page']>$pagecount) $_GET['page']=1;
	$start=($_GET['page']-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}answer ORDER BY answertime desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/javascript">
function checkDelAll(f)
{
	if( !confirm("您确定要删除所选答案吗")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="820" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">问题答案&nbsp;(<?php echo $acount;?>) &nbsp;&nbsp;&nbsp;[<a href="admin.php?admin_action=answer_search">搜索答案</a>]</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="Aform" action="admin.php" method=post onsubmit="return checkDelAll(this);">
		<tr bgcolor="#f8f8f8">
		<td width="20" align="center">&nbsp;</td>
		<td width="50" align="center">问题号</td>
		<td width="370" height="26" align="center">答案</td>
		<td width="100" height="26" align="center">回答者</td>
		<td width=80 align=center>回答时间</td>
		<td width=80 align=center>采纳时间</td>
		<td width=50 align=center>投票</td>
		<td width=45 align=center>修改</td>
		<td width=45 align=center>删除</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$query_c=$dblink->query("SELECT * FROM {$tablepre}answer_1 WHERE aid='$row[aid]'");
			$row_c=$dblink->fetch_array($query_c);
			$row=array_merge($row,$row_c);
			
			$row['content']=strip_tags($row['content']);
			$row['content']=str_replace("\r\n","",$row['content']);
			$row['content']=str_replace(" ","",$row['content']);
			$row['content']=cut_str($row['content'],60);
			$row['adopttime']=$row['adopttime'] ? date("n-j H:i",$row['adopttime']) :'未采纳';
			$row['joinvote']=$row['joinvote'] ? $row['votevalue'] : '未投票';
	
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align=center><input type="checkbox" name=aid[] value="<?php echo $row['aid'];?>" /></td>
		<td width="50" align="center"><a href="question.php?qid=<?php echo $row['qid'];?>" target="_blank"><?php echo $row['qid'];?></a></td>
		<td width="370" height="26" align="left"><a href="response.php?aid=<?php echo $row['aid'];?>" target="_blank"><?php echo $row['content'];?></a></td>
		<td width="100" align="center"><a href="member.php?username=<?php echo $row['username'];?>" target="_blank"><?php echo $row['username'];?></a></td>
		<td width="80" align="center"><?php echo date("n-j H:i",$row['answertime']);?></td>
		<td width="80" align="center"><?php echo $row['adopttime'];?></td>
		<td width="50" align="center"><?php echo $row['joinvote'];?></td>
		<td width="45" align="center"><a href="admin.php?admin_action=answer_edit&aid=<?php echo $row['aid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">编辑</a></td>
		<td width="45" align="center"><a href="admin.php?admin_action=answer_del&aid=<?php echo $row['aid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>" onclick="return confirm('确定要删除答案吗');">删除</a></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#ffffff">
		<td width=20 align="center"><input type="checkbox" name=aid_all value="all" onclick="checkAll(this, 'aid[]');" /></td>
		<td colspan=7 align="left"><?php echo $lang['select_all'];?></td>
		<td width=45 align=center>
		<input type="hidden" name="admin_action" value="answer_del" />
		<input type="hidden" name="backaction" value="<?php echo $admin_action;?>" />
		<input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
		<input type="submit" name="del_submit" value="<?php echo $lang['del'];?>" />
		</td>
		</tr>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="9" align="center">
		<font color="#000080">第<?php echo $_GET['page'];?>页/共<?php echo $pagecount;?>页</font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1" title="首页">首页</a>
       <?php
		if($pagecount>1)
		{
			$start = floor($_GET['page']/10)*10;
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
				if($_GET['page']==$i)
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
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>">尾页</a>
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
else if($admin_action=='answer_edit')
{
	
	if($_POST['ctype']=='edit_submit')
	{
		$content=filters_content($_POST['content']);
		$aid=intval($_POST['aid']);
		$dblink->query("UPDATE {$tablepre}answer_1 SET content='$content' where aid=$aid");
		header("location:admin.php?admin_action=$_POST[backaction]&page=$_POST[page]");
	}
	else
	{
		$aid=intval($_GET['aid']);
		$query=$dblink->query("SELECT * FROM {$tablepre}answer_1 WHERE aid='$aid'");
		$row=$dblink->fetch_array($query);
			
		$row['content']=filters_outcontent($row['content']);
		$row['content']=htmlspecialchars($row['content']);
		admin_header();
?>
<table cellspacing="1" cellpadding="0" width="760" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="22">修改答案</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		 <form name=Form1 action="admin.php" method="post">
		<tr bgcolor="#f8f8f8">
		<td width="100" align="center">修改答案</td>
		<td width="600" height="26" align="left">
		<input type="hidden" name="content" value="<?php echo $row['content'];?>" />
		<script type="text/javascript" src="cyaskeditor/CyaskEditor.js"></script>
		<script type="text/javascript">
<!--
var editor = new CyaskEditor("editor");
editor.hiddenName = "content";
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
		 <input type="hidden" name="admin_action" value="answer_edit" />
		 <input type="hidden" name="ctype" value="edit_submit" />
		 <input type="hidden" name="aid" value="<?php echo $row['aid'];?>" />
		 <input type="hidden" name="backaction" value="<?php echo $_GET['backaction'];?>" />
		 <input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
		 <input type="submit" name="submit" value="修改" onclick="cyaskeditorsubmit()" />
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
else if($admin_action=='answer_search')
{
	if(isset($_GET['search_submit']))
	{
		$qid=intval(trim($_GET['qid']));
		
		if(!$_GET['page']) $_GET['page']=1;
		$pagerow=20;
		
		$query=$dblink->query("SELECT count(*) FROM {$tablepre}answer where qid=$qid"); 
		$qcount=$dblink->result($query,0);
		$pagecount=ceil($qcount/$pagerow);
		if ($_GET['page']>$pagecount) $_GET['page']=1;
		$start=($_GET['page']-1)*$pagerow;
		$query=$dblink->query("SELECT * FROM {$tablepre}answer where qid=$qid ORDER BY answertime desc limit $start,$pagerow");
		admin_header();
?>
		<table cellspacing="1" cellpadding="0" width="820" align="center" class="tableborder">
		<tr><td>
			<table border="0" cellspacing="0" cellpadding="3" width="100%">
			<tr class="header"><td height="22">问题答案&nbsp;(<?php echo $qcount;?>) &nbsp;&nbsp;&nbsp;[<a href="admin.php?admin_action=answer_search">搜索答案</a>]</td></tr>
			<tr bgcolor="#f8f8f8"><td>
				<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
				<tr bgcolor="#f8f8f8">
				<td width="50" align="center">问题号码</td>
				<td width="370" height="26" align="center">答案</td>
				<td width="100" height="26" align="center">回答者</td>
				<td width=80 align=center>回答时间</td>
				<td width=80 align=center>采纳时间</td>
				<td width=50 align=center>投票</td>
				<td width=45 align=center>修改</td>
				<td width=45 align=center>删除</td>
			</tr>
			<?php
			while($row=$dblink->fetch_array($query))
			{
				$query_c=$dblink->query("SELECT * FROM {$tablepre}answer_1 WHERE aid='$row[aid]'");
				$row_c=$dblink->fetch_array($query_c);
				$row=array_merge($row,$row_c);
			
				$row['content']=strip_tags($row['content']);
				$row['content']=str_replace("\r\n","",$row['content']);
				$row['content']=str_replace(" ","",$row['content']);
				$row['content']=cut_str($row['content'],60);
				$row['adopttime']=$row['adopttime'] ? date("n-j H:i",$row['adopttime']) :'未采纳';
				$row['joinvote']=$row['joinvote'] ? $row['votevalue'] : '未投票';
	
			?>
			<tr bgcolor="#ffffff">
			<td width="50" align="center"><a href="question.php?qid=<?php echo $row['qid'];?>" target="_blank"><?php echo $row['qid'];?></a></td>
			<td width="370" height="26" align="left"><a href="response.php?aid=<?php echo $row['aid'];?>" target="_blank"><?php echo $row['content'];?></a></td>
			<td width="100" align="center"><a href="member.php?username=<?php echo $row['username'];?>" target="_blank"><?php echo $row['username'];?></a></td>
			<td width="80" align="center"><?php echo date("n-j H:i",$row['answertime']);?></td>
			<td width="80" align="center"><?php echo $row['adopttime'];?></td>
			<td width="50" align="center"><?php echo $row['joinvote'];?></td>
			<td width="45" align="center"><a href="admin.php?admin_action=answer_edit&aid=<?php echo $row['aid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">编辑</a></td>
			<td width="45" align="center"><a href="admin.php?admin_action=answer_del&qid=<?php echo $row['qid'];?>&aid=<?php echo $row['aid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>" onclick="return confirm('确定要删除答案吗');">删除</a></td>
			</tr>
			<?php
			}
			?>
			<tr bgcolor="#F8F8F8" height="30"><td colspan="8" align="center">
			<font color="#000080">第<?php echo $_GET['page'];?>页/共<?php echo $pagecount;?>页</font>
			<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1" title="首页">首页</a>
			<?php
			if($pagecount>1)
			{
				$start = floor($_GET['page']/10)*10;
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
					if($_GET['page']==$i)
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
			<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>">尾页</a>
			</td></tr>
			</table>
		</td></tr>
		</table>
		</td></tr>
		</table>
<?php
	}
	else
	{
		admin_header();
?>
<table cellspacing="1" cellpadding="0" width="760" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="22">搜索答案</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name=Form1 action="admin.php" method="get">
		<tr valign="middle" bgcolor="#f8f8f8">
		<td width="100" height="35" align="center">问题号码</td>
		<td width="600" align="left">
		<input type="text" name="qid" size="30" />
		</td>
		</tr>
		<tr valign="middle" bgcolor="#f8f8f8">
		<td width="100" height="30" align="center">&nbsp;</td>
		<td width="600" align="left">
		 <input type="hidden" name="admin_action" value="answer_search" />
		 <input type="submit" name="search_submit" value="搜索" />
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
else if($admin_action=='answer_del')
{
	$aids = isset($_GET['aid']) ? array($_GET['aid']) : $_POST['aid'];
	
	foreach($aids as $aid)
	{
		$aid = intval($aid);
		$query = $dblink->query("SELECT qid,tableid FROM {$tablepre}answer where aid=$aid");
		$row = $dblink->fetch_array($query);
		$qid = intval($row['qid']);
		$answer_table = $tablepre.'answer_'.$row['tableid'];
		$dblink->query("DELETE FROM {$tablepre}answer WHERE aid=$aid");
		$dblink->query("DELETE FROM $answer_table WHERE aid=$aid");
		$dblink->query("UPDATE {$tablepre}question SET answercount=answercount-1 WHERE qid=$qid");
	}
	
	header("location:admin.php?admin_action=$_REQUEST[backaction]&page=$_REQUEST[page]");
}

else
{
	echo 'answer_manage error';
}
?>