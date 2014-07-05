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
if($_GET['admin_action']=='user_list')
{
	if(!$_GET['page']) $_GET['page']=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}member where adminid=5"); 
	$mcount=$dblink->result($query,0);
	$pagecount=ceil($mcount/$pagerow);
	if ($_GET['page']>$pagecount) $_GET['page']=1;
	$start=($_GET['page']-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}member where adminid=5 ORDER BY uid desc limit $start,$pagerow");
	
	admin_header();
?>
<script type="text/JavaScript">
function deleteuser()
{
	if( !confirm("你确定要删除该用户吗？")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">注册用户&nbsp;(<?php echo $mcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<tr bgcolor="#f8f8f8">
		<td width=100 height=26 align=center>用户名</td>
		<td width=45 align=center>性别</td>
		<td width=80 align=center>最后登录</td>
		<td width=100 align=center>email</td>
		<td width=60 align=center>qq</td>
		<td width=100 align=center>msn</td>
		<td width=50 align=center>总积分</td>
		<td width=45 align=center>积分</td>
		<td width=45 align=center>编辑</td>
		<td width=45 align=center>删除</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$row['gender']=$row['gender']==0 ? '未设置' : ($row['gender']==1 ? '男' : '女');
			$row['qq']=$row['qq'] ? $row['qq']:'n/a';
			$row['msn']=$row['msn'] ? $row['msn']:'n/a';
		?>
		<tr bgcolor="#ffffff">
		<td width=100 align=center><a href="member.php?uid=<?php echo $row['uid'];?>" title="<?php echo $row['email'];?>" target="_blank"><?php echo $row['username'];?></a></td>
		<td width=45 align=center><?php echo $row['gender']?></td>
		<td width=80 align=center><?php echo date("y-m-d",$row['lastlogin']);?></td>
		<td width=100 align=center><?php echo $row['email'];?></td>
		<td width=60 align=center><?php echo $row['qq'];?></td>
		<td width=100 align=center><?php echo $row['msn'];?></td>
		<td width=50 align=center><?php echo $row['allscore'];?></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_score_manage&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">调整</a></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_edit&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">编辑</a></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_del&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>" onclick="if( !deleteuser() ) return false;">删除</a></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#F8F8F8" height=30><td colspan=10 align=center>
		<font color="#000080">第<?php echo $_GET[page];?>页/共<?php echo $pagecount;?>页</font>
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
	admin_footer();
	exit();
}
elseif($_GET['admin_action']=='manager_list')
{
	if(!$_GET['page']) $_GET['page']=1;
	$pagerow=20;
	
	$query=$dblink->query("SELECT count(*) FROM {$tablepre}admin where adminid=2"); 
	$mcount=$dblink->result($query,0);
	$pagecount=ceil($mcount/$pagerow);
	if ($_GET['page']>$pagecount) $_GET['page']=1;
	$start=($_GET['page']-1)*$pagerow;
	$query=$dblink->query("SELECT * FROM {$tablepre}admin where adminid=2 ORDER BY adminid asc limit $start,$pagerow");
	
	admin_header();
?>
<script type="text/JavaScript">
function delete_manager()
{
	if( !confirm("你确定要撤消该管理员吗？")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">管理员&nbsp;(<?php echo $mcount;?>) &nbsp;&nbsp;&nbsp;<a href="admin.php?admin_action=manager_add&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">添加管理员</a></td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<tr bgcolor="#f8f8f8">
		<td width=100 height=26 align=center>用户名</td>
		<td width=45 align=center>性别</td>
		<td width=80 align=center>最后登录</td>
		<td width=100 align=center>email</td>
		<td width=100 align=center>qq</td>
		<td width=100 align=center>msn</td>
		<td width=100 align=center>权限等级</td>
		<td width=45 align=center>设置</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$query1=$dblink->query("SELECT * FROM {$tablepre}member where uid=$row[uid]"); 
			$row1=$dblink->fetch_array($query1);
			$row=array_merge($row,$row1);
			$row['gender']=$row['gender']==1 ? '男' : ($row['gender']==2 ? '女' : '未设置');
			$row['qq']=$row['qq'] ? $row['qq']:'n/a';
			$row['msn']=$row['msn'] ? $row['msn']:'n/a';
			$row['admin']= $row['adminid']==1 ? '超级管理' : '普通管理';
		?>
		<tr bgcolor="#ffffff">
		<td width=100 align=center><a href="member.php?uid=<?php echo $row['uid'];?>" title="<?php echo $row['email'];?>" target="_blank"><?php echo $row['username'];?></a></td>
		<td width=45 align=center><?php echo $row['gender']?></td>
		<td width=80 align=center><?php echo date("y-m-d",$row['lastlogin']);?></td>
		<td width=100 align=center><?php echo $row['email'];?></td>
		<td width=100 align=center><?php echo $row['qq'];?></td>
		<td width=100 align=center><?php echo $row['msn'];?></td>
		<td width=100 align=center><?php echo $row['admin'];?></td>
		<td width=45 align=center><a href="admin.php?admin_action=manager_edit&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">修改</a></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#F8F8F8" height=30><td colspan=12 align=center>
		<font color="#000080">第<?php echo $_GET[page];?>页/共<?php echo $pagecount;?>页</font>
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
	admin_footer();
	exit();
}
elseif($admin_action=='user_find')
{
	if($_GET['ctype']=='find_submit')
	{
		if(!$_GET['page']) $_GET['page']=1;
		$pagerow=20;
		$username=trim($_GET['username']);
		$query=$dblink->query("SELECT count(*) FROM {$tablepre}member WHERE username LIKE '%$username%'"); 
		$mcount=$dblink->result($query,0);
		$pagecount=ceil($mcount/$pagerow);
		if ($_GET['page']>$pagecount) $_GET['page']=1;
		$start=($_GET['page']-1)*$pagerow;
		$query=$dblink->query("SELECT * FROM {$tablepre}member WHERE username LIKE '%$username%' limit $start,$pagerow");
		
	admin_header();
?>
<script type="text/javascript">
function deleteuser()
{
	if( !confirm("你确定要删除该用户吗？")) return false;
	else return true;
}
</script>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">找到用户&nbsp;(<?php echo $mcount;?>)</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<tr bgcolor="#f8f8f8">
		<td width=100 height=26 align=center>用户名</td>
		<td width=45 align=center>性别</td>
		<td width=80 align=center>最后登录</td>
		<td width=100 align=center>email</td>
		<td width=60 align=center>qq</td>
		<td width=100 align=center>msn</td>
		<td width=50 align=center>总积分</td>
		<td width=45 align=center>积分</td>
		<td width=45 align=center>编辑</td>
		<td width=45 align=center>删除</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
			$row['gender']=$row['gender']==0 ? '未设置' : ($row['gender']==1 ? '男' : '女');
			$row['qq']=$row['qq'] ? $row['qq']:'n/a';
			$row['msn']=$row['msn'] ? $row['msn']:'n/a';
		?>
		<tr bgcolor="#ffffff">
		<td width=100 align=center><a href="member.php?uid=<?php echo $row['uid'];?>" title="<?php echo $row['email'];?>" target="_blank"><?php echo $row['username'];?></a></td>
		<td width=45 align=center><?php echo $row['gender']?></td>
		<td width=80 align=center><?php echo date("y-m-d",$row['lastlogin']);?></td>
		<td width=100 align=center><?php echo $row['email'];?></td>
		<td width=60 align=center><?php echo $row['qq'];?></td>
		<td width=100 align=center><?php echo $row['msn'];?></td>
		<td width=50 align=center><?php echo $row['allscore'];?></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_score_manage&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">调整</a></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_edit&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>">编辑</a></td>
		<td width=45 align=center><a href="admin.php?admin_action=user_del&uid=<?php echo $row['uid'];?>&backaction=<?php echo $admin_action;?>&page=<?php echo $_GET['page'];?>" onclick="if( !deleteuser() ) return false;">删除</a></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#F8F8F8" height=30><td colspan=12 align=center>
		<font color="#000080">第<?php echo $_GET[page];?>页/共<?php echo $pagecount;?>页</font>
		<a href="admin.php?admin_action=<?php echo $admin_action;?>&ctype=find_submit&username=<?php echo $username;?>&page=1" title="首页">首页</a>
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
					echo '<a href="admin.php?admin_action='.$admin_action.'&ctype=find_submit&username='.$username.'&page='.$i.'">&nbsp;['.$i.']</a>';          
				}
			}
		}
	 ?>                                                                                                                                                                                                                                                                                                                                                                                                                
     <a href="admin.php?admin_action=<?php echo $admin_action;?>&ctype=find_submit&username=<?php echo $username;?>&page=<?php echo $pagecount;?>">尾页</a>
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
<script language="javascript">
function check_sortform(f)
{
 	if(f.username.value =="")
 	{
  		alert("请填写您要找的用户名！");
		f.username.focus();
		return false;
 	}
}
</script>
<br><br>
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td colspan=2 height="22">查找用户</td></tr>
	<form method="get" action="admin.php" name="sortForm" onSubmit="return check_sortform(this)">
    <tr bgcolor="#F8F8F8"><td colspan="2" height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right">用户名：</td>
      <td align="left">
	<input name="username" type="text" size="22" maxlength="18">
     </td>
    </tr>
    <tr bgcolor="#F8F8F8"> 
     <td width="80" height="25" align="right">&nbsp;</td>
     <td align="left">
      <input name="admin_action" type="hidden" value="user_find">
      <input name="ctype" type="hidden" value="find_submit">
      <input type="submit" value="提交" name="B1">&nbsp;&nbsp;
      <input onclick="javascript:history.back();" type="button" value="返回"> 
      </td>
    </tr>
     <tr bgcolor="#ffffff"><td colspan=2 height="20"></td></tr>
  </form>
	</table>
</td></tr>
</table>
<?php
	}
	admin_footer();
	exit();
}
elseif($admin_action=='manager_add')
{
	if(isset($_POST['add_submit']))
	{
		$username=trim($_POST['username']);
		if(is_array($_POST['sort']))
		{
			$sidlist=implode(',',$_POST['sort']);
		}
		
		$query=$dblink->query("SELECT uid,adminid FROM {$tablepre}member WHERE username='$username'");
		$member=$dblink->fetch_array($query);
		if($member['adminid']==5 && $sidlist)
		{
			$query1=$dblink->query("REPLACE INTO {$tablepre}admin SET uid=$member[uid],adminid=2,sid='$sidlist'");
			
			if($query1)
			{
				$dblink->query("UPDATE {$tablepre}member SET adminid=2 WHERE uid=$member[uid]");
			}
		}
		
		header("location:admin.php?admin_action=manager_list&page=$_POST[page]");
	}
	else
	{
		$query=$dblink->query("SELECT sid,sort1 FROM {$tablepre}sort WHERE grade=1");
		admin_header();
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
<form name="addForm" action="admin.php" method="post">
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2 height="22">添加管理员</td></tr>
    <tr valign="middle" bgcolor="#F8F8F8"><td colspan="2" height="20"></td></tr>
    <tr valign="middle" bgcolor="#ffffff"> 
      <td width="80" height="30" align="right">用户名：</td>
      <td align="left"><input name="username" type="text" value="<?php echo $_GET['username'];?>" /></td>
    </tr>
     <tr valign="middle" bgcolor="#f8f8f8"> 
     <td width="80" height="50" align="right">管理分类：</td>
     <td align="left">
     <?php
     while($row=$dblink->fetch_array($query))
     {
		echo '<input type="checkbox" name=sort[] value="'.$row['sid'].'" />'.$row['sort1'].'<br />';
     }
     ?>
     </td>
    </tr>
    <tr valign="middle" bgcolor="#ffffff"> 
     <td width="80" height="30" align="right">&nbsp;</td>
     <td align="left">
      <input name="admin_action" type="hidden" value="manager_add" />
      <input name="page" type="hidden" value="<?php echo $_GET['page'];?>" />
      <input name="add_submit" type="submit" value="提交" />&nbsp;&nbsp;
      <input onclick="javascript:history.back();" type="button" value="返回" /> 
      </td>
    </tr>
     <tr bgcolor="#f8f8f8"><td colspan=2 height="20"></td></tr>
	</table>
</form>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}
elseif($admin_action=='manager_edit')
{
	if(isset($_POST['edit_submit']))
	{
		$uid=intval($_POST['uid']);
		if(is_array($_POST['sort']) && count($_POST['sort'])>0)
		{
			$sidlist=implode(',',$_POST['sort']);
		}
		
		if($sidlist)
		{
			$dblink->query("UPDATE {$tablepre}admin SET sid='$sidlist' WHERE uid=$uid");
		}
		else
		{
			$dblink->query("DELETE FROM {$tablepre}admin WHERE uid=$uid");
			$dblink->query("UPDATE {$tablepre}member SET adminid=5 WHERE uid=$uid");
		}
		
		header("location:admin.php?admin_action=manager_list&page=$_POST[page]");
	}
	else
	{
		$uid=intval($_GET['uid']);
		$query=$dblink->query("SELECT username FROM {$tablepre}member WHERE uid=$uid");
		$member=$dblink->fetch_array($query);
		
		$query=$dblink->query("SELECT sid FROM {$tablepre}admin WHERE uid=$uid");
		$sort=$dblink->result($query,0);
		$sort=explode(',',$sort);
		
		$query=$dblink->query("SELECT sid,sort1 FROM {$tablepre}sort WHERE grade=1");
		admin_header();
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
<form name="addForm" action="admin.php" method="post">
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2 height="22">修改管理员权限</td></tr>
    <tr valign="middle" bgcolor="#F8F8F8"><td colspan="2" height="20"></td></tr>
    <tr valign="middle" bgcolor="#ffffff"> 
      <td width="80" height="30" align="right">用户名：</td>
      <td align="left"><?php echo $member['username'];?></td>
    </tr>
     <tr valign="middle" bgcolor="#f8f8f8"> 
     <td width="80" height="50" align="right">管理分类：</td>
     <td align="left">
     <?php
     while($row=$dblink->fetch_array($query))
     {
		if(in_array($row['sid'],$sort))
		{
			echo '<input type="checkbox" name=sort[] value="'.$row['sid'].'" checked />'.$row['sort1'].'<br />';
		}
		else
		{
			echo '<input type="checkbox" name=sort[] value="'.$row['sid'].'" />'.$row['sort1'].'<br />';
		}
     }
     ?>
     </td>
    </tr>
    <tr valign="middle" bgcolor="#ffffff"> 
     <td width="80" height="30" align="right">&nbsp;</td>
     <td align="left">
      <input name="admin_action" type="hidden" value="manager_edit" />
      <input name="uid" type="hidden" value="<?php echo $uid;?>" />
      <input name="page" type="hidden" value="<?php echo $_GET['page'];?>" />
      <input name="edit_submit" type="submit" value="修改" />&nbsp;&nbsp;
      <input onclick="javascript:history.back();" type="button" value="返回" /> 
      </td>
    </tr>
     <tr bgcolor="#f8f8f8"><td colspan=2 height="20"></td></tr>
	</table>
</form>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}
elseif($admin_action=='user_score_manage')
{
	if(isset($_POST['submit']))
	{
		$uid=intval($_POST['score_uid']);
		$score=intval($_POST['score_value']);
		
		$query=$dblink->query("SELECT allscore FROM {$tablepre}member WHERE uid=$uid");
		$allscore=$dblink->result($query,0);
		if($_POST['score_type']=='+')
		{
			$allscore=$allscore+$score;
		}
		else
		{
			$allscore=$allscore-$score;
			$allscore=$allscore<0 ? 0 : $allscore;
		}
		
		$dblink->query("UPDATE {$tablepre}member SET allscore='$allscore' WHERE uid='$uid'");
		
		header("location:admin.php?admin_action=$_POST[backaction]&page=$_POST[page]");
	}
	else
	{
		$uid=intval($_GET['uid']);
		$query=$dblink->query("SELECT uid,username,allscore FROM {$tablepre}member WHERE uid=$uid");
		$row=$dblink->fetch_array($query);
		admin_header();
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2 height="22">修改用户积分</td></tr>
	<form method="post" action="admin.php" name="sortForm">
    <tr bgcolor="#f8f8f8">
    <td colspan="2" height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right">用户名：</td>
      <td align="left"><?php echo $row['username'];?></td>
    </tr>
     <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">总积分：</td>
     <td align="left"><?php echo $row['allscore'];?></td>
    </tr>
     <tr bgcolor="#ffffff"> 
     <td width="80" height="25" align="right">积分调整：</td>
     <td align="left">
     <select name="score_type" size="2">
		<option value="+" selected>加</option>
		<option value="-">减</option>
     </select>
	<input name="score_value" type="text" size="6" maxlength="6" />
     </td>
    </tr>
    <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">&nbsp;</td>
     <td align="left">
      <input name="admin_action" type="hidden" value="user_score_manage" />
      <input name="score_uid" type="hidden" value="<?php echo $row['uid'];?>" />
      <input name="backaction" type="hidden" value="<?php echo $_GET['backaction'];?>" />
      <input name="page" type="hidden" value="<?php echo $_GET['page'];?>" />
      <input type="submit" value="提交" name="submit" />&nbsp;&nbsp;
      <input onclick="javascript:history.back();" type="button" value="返回" /> 
      </td>
    </tr>
     <tr bgcolor="#ffffff"><td colspan=2 height="20"></td></tr>
  </form>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}
elseif($admin_action=='user_edit')
{
	if(isset($_POST['submit']))
	{
		$uid=intval($_POST['score_uid']);
		
		$dblink->query("UPDATE {$tablepre}member SET gender='$_POST[gender]',bday='$_POST[bday]',qq='$_POST[qq]',msn='$_POST[msn]',attachopen='$_POST[attachopen]',signature='$_POST[signature]' WHERE uid='$uid'");
		
		header("location:admin.php?admin_action=$_POST[backaction]&page=$_POST[page]");
	}
	else
	{
		$uid=intval($_GET['uid']);
		$query=$dblink->query("SELECT * FROM {$tablepre}member WHERE uid=$uid");
		$row=$dblink->fetch_array($query);
		admin_header();
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2 height="22">修改用户资料</td></tr>
	<form method="post" action="admin.php" name="sortForm">
    <tr bgcolor="#f8f8f8">
    <td colspan="2" height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right">用户名：</td>
      <td align="left"><?php echo $row['username'];?></td>
    </tr>
     <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">上传：</td>
     <td align="left">
		<select name="attachopen">
		<option value="0" <?php if($row['attachopen']==0) echo 'selected';?>>不允许</option>
		<option value="1" <?php if($row['attachopen']==1) echo 'selected';?>>允许</option>
     </select>
     是否可以上传附件
     </td>
    </tr>
     <tr bgcolor="#ffffff"> 
     <td width="80" height="25" align="right">性别：</td>
     <td align="left">
     <select name="gender">
		<option value="0" <?php if($row['gender']==0) echo 'selected';?>>未知</option>
		<option value="1" <?php if($row['gender']==1) echo 'selected';?>>男</option>
		<option value="2" <?php if($row['gender']==2) echo 'selected';?>>女</option>
     </select></td>
    </tr>
     <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">生日：</td>
     <td align="left">
		<input name="bday" type="text" size="10" maxlength="10" value="<?php echo $row['bday'];?>" />
     </td>
    </tr>
    <tr bgcolor="#ffffff"> 
     <td width="80" height="25" align="right">QQ：</td>
     <td align="left">
		<input name="qq" type="text" size="15" value="<?php echo $row['qq'];?>" />
     </td>
    </tr>
    <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">MSN：</td>
     <td align="left">
		<input name="msn" type="text" size="15" value="<?php echo $row['msn'];?>" />
     </td>
    </tr>
    <tr bgcolor="#ffffff"> 
     <td width="80" height="25" align="right">个人简介：</td>
     <td align="left">
		<textarea name="signature" cols=60 rows=8><?php echo $row['signature'];?></textarea>
     </td>
    </tr>
    <tr bgcolor="#f8f8f8"> 
     <td width="80" height="25" align="right">&nbsp;</td>
     <td align="left">
      <input name="admin_action" type="hidden" value="user_edit" />
      <input name="score_uid" type="hidden" value="<?php echo $row['uid'];?>" />
      <input name="backaction" type="hidden" value="<?php echo $_GET['backaction'];?>" />
      <input name="page" type="hidden" value="<?php echo $_GET['page'];?>" />
      <input type="submit" value="提交" name="submit" />&nbsp;&nbsp;
      <input onclick="javascript:history.back();" type="button" value="返回" /> 
      </td>
    </tr>
     <tr bgcolor="#ffffff"><td colspan=2 height="20"></td></tr>
  </form>
	</table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}
elseif($admin_action=='user_del')
{
	$uid=intval($_GET[uid]);
	$dblink->query("DELETE FROM {$tablepre}member where uid='$uid'");
	$dblink->query("DELETE FROM {$tablepre}question where uid='$uid'");
	$dblink->query("DELETE FROM {$tablepre}score where uid='$uid'");
	
	header("location:admin.php?admin_action=$_GET[backaction]&page=$_GET[page]");

}
else
{
	echo 'user_manage error';
}
?>