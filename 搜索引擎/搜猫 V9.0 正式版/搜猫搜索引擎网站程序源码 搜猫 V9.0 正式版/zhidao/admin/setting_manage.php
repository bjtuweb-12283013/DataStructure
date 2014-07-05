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
	header("location:admin.php?admin_action=login&backaction=$_GET[admin_action]");
}
if($admin_action=='var_setting')
{
	$query=$dblink->query("SELECT * FROM {$tablepre}set WHERE T in('str','num') order by T");
	admin_header();
?>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">参数列表</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<tr bgcolor="#ffffff">
		<td height="23" width=200 align=center>项目</td>
		<td width=300 align=center>数值</td>
		<td width=300 align=center>变量</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
		?>
		<tr bgcolor="#ffffff">
		<td height="23" width=200><?php echo $lang[$row['K']];?></td>
		<td width=300><?php echo $row['V'];?></td>
		<td width=300><?php echo '$'.$row['K']?></td>
		</tr>
		<?php
		}
		?>
		</table>
	</td></tr>
	<tr bgcolor="#f8f8f8"><td><a href="admin.php?admin_action=setting_edit">&gt&gt更改参数</a></td></tr>
	</table>
</td></tr>
</table>
<?php
  admin_footer();
	exit();
}
elseif($admin_action=='setting_edit')
{
	if(isset($_POST['edit_submit']))
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}set WHERE T in('str','num')");
		while($row=$dblink->fetch_array($query))
		{
			$dblink->query("UPDATE {$tablepre}set SET V='".$_POST[$row[K]]."' WHERE K='".$row[K]."'");
		}
		create_cache('variable');
		header("location:admin.php?admin_action=var_setting");
	}
	else
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}set WHERE T in('str','num') order by T");
		admin_header();
?>
<table cellspacing="1" cellpadding="0" width="800" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr class="header"><td height="22">更改参数</td></tr>
	<tr bgcolor="#f8f8f8"><td>
		<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" width="100%">
		<form name="settingform" action="admin.php" method="post">
		<tr bgcolor="#ffffff">
		<td height="23" width=200 align=center>项目</td>
		<td width=300 align=center>数值</td>
		<td width=300 align=center>变量</td>
		</tr>
		<?php
		while($row=$dblink->fetch_array($query))
		{
		?>
		<tr bgcolor="#ffffff">
		<td height="23" width=200><?php echo $lang[$row['K']];?></td>
		<td width=300><input type=text name="<?php echo $row['K'];?>" value="<?php echo $row['V'];?>" size=50></td>
		<td width=300><?php echo '$'.$row['K']?></td>
		</tr>
		<?php
		}
		?>
		<tr bgcolor="#f8f8f8">
		<td width=100 colspan=3 height=30>
		<input type=hidden name=edit_submit value="1">
		<input type=hidden name=admin_action value="setting_edit">
		<input type=submit name=submit value="更新">&nbsp;&nbsp;
		<input type=button name=submit2 value="撤消" onclick="history.back()" /></td>
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

else
{
	echo 'setting_manage error';
}
?>