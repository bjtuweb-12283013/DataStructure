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

if($admin_action=='announcement')
{
	if(!$page) $page=1;
	$pagerow=20;
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}notice"); 
	$notecount=$dblink->result($query,0);
	$pagecount=ceil($notecount/$pagerow);
	if ($page>$pagecount) $_GET['page']=1;
	$start=($page-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}notice ORDER BY time desc limit $start,$pagerow");
	admin_header();
?>
<script type="text/JavaScript">
function disQstate(s)
{ 
	switch (s)
	{
		case 0:var op="<font color=#8b0000>私藏</font>";break;
		case 1:var op="<font color=#006400>共享</font>";break;
		default: var op="未知";
	}
	document.write(op);
}
</script>
<table cellspacing="1" cellpadding="0" width="750" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height=23>公告管理&nbsp;(<?php echo $notecount;?>)&nbsp;&nbsp;&nbsp;-&gt<a href="admin.php?admin_action=announcement_add"><u>发布新公告</u></a></td></tr>
	<tr bgcolor="#f8f8f8">
	<td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<tr bgcolor="#f8f8f8">
		<td width="400" height="26" align="center">公告标题</td>
		<td width="100" align="center">管理员</td>
		<td width="150" align=center>编辑时间</td>
		<td width="50" align=center>编辑</td>
		<td width="50" align=center>删除</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$row['edittime']=date("y-m-d H:i",$row['time']);
			if(empty($row['url']))
			{
				$manageurl='notice.php?id='.$row['id'];
			}
			else
			{
				$manageurl=$row['url'];
			}
		?>
		<tr bgcolor="#ffffff">
		<td height="26" align="center"><a href="<?php echo $manageurl;?>" target="_blank"><?php echo $row['title'];?></a></td>
		<td align="center"><a href="member.php?username=<?php echo $row['author'];?>" target="_blank"><?php echo $row['author'];?></a></td>
		<td align="center"><?php echo $row['edittime'];?></td>
		<td align="center"><a href="admin.php?admin_action=announcement_edit&id=<?php echo $row['id'];?>&page=<?php echo $page;?>">编辑</a></td>
		<td align="center"><a href="admin.php?admin_action=announcement_del&id=<?php echo $row['id'];?>&page=<?php echo $page;?>" onclick="if( !deleteit() ) return false;">删除</a></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#F8F8F8" height="30"><td colspan="5" align="center">
		<font color="#000080">第<?php echo $page;?>页/共<?php echo $pagecount;?>页</font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&page=1">首页</a>
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
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&page=<?php echo $pagecount;?>">尾页</a>
		</td></tr>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit;
}
elseif($admin_action=='announcement_add')
{
	admin_header();
?>
<table cellspacing="1" cellpadding="0" width="750" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height=23>发布公告</td></tr>
	<tr><td bgcolor="#ffffff" height="2">&nbsp;</td></tr>
	<tr bgcolor="#f8f8f8">
	<td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="f1" action="admin.php" method="post">
		<input type="hidden" name="admin_action" value="announcement_add_submit" />
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">公告标题:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="title" size="80" maxlength="50" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="26" align="center" valign="top">公告内容:</td>
		<td width="630" align="left">&nbsp;
		<input type="hidden" name="content" value="" />
		<script type="text/javascript" src="cyaskeditor/CyaskEditor.js"></script>
		<script type="text/javascript">
<!--
var editor = new CyaskEditor("editor");
editor.hiddenName = "content";
editor.editorType = "simple";
editor.editorWidth = "500px";
editor.editorHeight = "300px";
editor.show();
function cyaskeditorsubmit(){editor.data();}
-->
	</script>
		</td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">转向地址:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="url" size="80" maxlength="125" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">发布人:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="author" size="30" maxlength="18" value="<?php echo $cyask_user;?>" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">&nbsp;</td>
		<td width="630" align="left">&nbsp;<input type="submit" name="submit" value="发布公告" onclick="cyaskeditorsubmit()" /></td>
		</tr>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit;
}
elseif($admin_action=='announcement_edit')
{
	$id=intval($_GET['id']);
	$page=intval($_GET['page']);
	$query=$dblink->query("SELECT * FROM {$tablepre}notice WHERE id=$id");
	$row=$dblink->fetch_array($query);
	$row['content']=filters_outcontent($row['content']);
	$row['content']=htmlspecialchars($row['content']);
	admin_header();
?>
<table cellspacing="1" cellpadding="0" width="750" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height=23>修改公告</td></tr>
	<tr><td bgcolor="#ffffff" height="2">&nbsp;</td></tr>
	<tr bgcolor="#f8f8f8">
	<td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="f1" action="admin.php" method="post">
		<input type="hidden" name="admin_action" value="announcement_edit_submit" />
		<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
		<input type="hidden" name="page" value="<?php echo $page;?>" />
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">公告标题:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="title" size="80" maxlength="50" value="<?php echo $row['title'];?>" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="26" align="center" valign="top">公告内容:</td>
		<td width="630" align="left">&nbsp;
		<input type="hidden" name="content" value="<?php echo $row['content'];?>" />
		<script type="text/javascript" src="cyaskeditor/CyaskEditor.js"></script>
		<script type="text/javascript">
<!--
var editor = new CyaskEditor("editor");
editor.hiddenName = "content";
editor.editorType = "simple";
editor.editorWidth = "500px";
editor.editorHeight = "300px";
editor.show();
function cyaskeditorsubmit(){editor.data();}
-->
	</script>
		</td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">转向地址:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="url" size="80" maxlength="125" value="<?php echo $row['url'];?>" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">发布人:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="author" size="30" maxlength="18" value="<?php echo $row['author'];?>" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">显示顺序:</td>
		<td width="630" align="left">&nbsp;<input type="text" name="orderid" size="5" maxlength="3" value="<?php echo $row['orderid'];?>" /></td>
		</tr>
		<tr bgcolor="#f8f8f8">
		<td width="120" height="35" align="center">&nbsp;</td>
		<td width="630" align="left">&nbsp;<input type="submit" name="submit" value="修改公告" onclick="cyaskeditorsubmit()" /></td>
		</tr>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit;
}
elseif($admin_action=='announcement_add_submit')
{
	$nowtime=time();
	$dblink->query("INSERT INTO {$tablepre}notice SET author='$_POST[author]',title='$_POST[title]',content='$_POST[content]',time='$nowtime',url='$_POST[url]'");
	header("location:admin.php?admin_action=announcement");
}
elseif($admin_action=='announcement_edit_submit')
{
	$id=intval($_POST['id']);
	$page=intval($_POST['page']);
	$nowtime=time();
	$content=filters_content($_POST['content']);
	$dblink->query("UPDATE {$tablepre}notice SET author='$_POST[author]',title='$_POST[title]',content='$content',time='$nowtime',orderid='$_POST[orderid]',url='$_POST[url]' WHERE id=$id");
	header("location:admin.php?admin_action=announcement&page=$page");
}
elseif($admin_action=='announcement_del')
{
	$id=intval($_GET['id']);
	$page=intval($_GET['page']);
	$dblink->query("DELETE FROM $tablepre"."notice WHERE id=$id");	
	header("location:admin.php?admin_action=announcement&page=$page");
}
else
{
	echo 'announcement manage error';
	exit;
}
?>