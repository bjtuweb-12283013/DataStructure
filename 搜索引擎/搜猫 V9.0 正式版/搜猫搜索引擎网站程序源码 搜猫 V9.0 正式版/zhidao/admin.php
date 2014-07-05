<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'admin');
@set_time_limit(600);
require './include/common.inc.php';
require_once CYASK_ROOT.'./admin/admin.func.php';
include_once language('admin');

$admin_action = isset($_GET['admin_action']) ? $_GET['admin_action'] : $_POST['admin_action'];
$admin_action = empty($admin_action) ? 'top':$admin_action;
$grade = $_GET['grade'] ? $_GET['grade'] : 1;

$admin_login = ($cyask_uid >0 && ($cyask_adminid ==1 || $cyask_adminid ==2)) ? 1:0;

if(isset($_POST['login_submit']))
{
	if(check_submit($_POST['login_submit'], $_POST['formhash']))
	{
		$username = trim($_POST['username']);
		$username = daddslashes($username);
		$md5passwd = md5($_POST['password']);
		
		$query = $dblink->query("SELECT uid,password FROM {$tablepre}member WHERE username='$username'");
		$rows = $dblink->num_rows($query);
		if($rows)
		{
			$userinfo = $dblink->fetch_array($query);
			if($userinfo['password'] == $md5passwd)
			{
				$userid = $userinfo['uid'];
				
				$url = empty($url) ? './' : $url;
				set_cookie('compound', authcode("$userid\t$username\t$md5passwd", 'ENCODE', $cyask_key));
				set_cookie('styleid', $styleid);

				echo "<script type=\"text/javascript\">location.href=\"./admin.php\";</script>";
			}
			else
			{
				admin_header();
				echo "<script type=\"text/javascript\">alert(\"$lang[password_error]\");history.back();</script>";
				admin_footer();
			}
		}
		else
		{
			admin_header();
			echo "<script type=\"text/javascript\">alert(\"$lang[login_invalid]\");history.back();</script>";
			admin_footer();
		}
		
	}
	else
	{
		admin_header();
		echo "<script type=\"text/javascript\">alert(\"$lang[url_error]\");history.back();</script>";
		admin_footer();
	}
}

if($admin_login == 0)
{
	admin_header();
	admin_login();
	admin_footer();
}

if($admin_action == 'top')
{
	print<<<END
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=$charset" />
<title>CYASK admin</title>
</head>
<frameset rows=30,* cols="*" frameborder="yes" border="1" framespacing="6">
<frame name="header" noresize scrolling="no" src="admin.php?admin_action=header">
<frameset cols="160,*" frameborder="no" border="0" framespacing="0" rows="*">
<frame name="menu" noresize scrolling="yes" src="admin.php?admin_action=menu">
<frame name="main" noresize scrolling="yes" src="admin.php?admin_action=home">
</frameset></frameset>
<noframes></noframes>
</html>
END;
	exit();

}
elseif($admin_action == 'menu')
{
	include_once (CYASK_ROOT.'./admin/menu.inc.php');
}
elseif($admin_action == 'header')
{
	require_once (CYASK_ROOT.'./admin/header.inc.php');
}
elseif($admin_action == 'home')
{
	if(!$cyask_adminid)
	{
		admin_header();
		admin_msg('noaccess');
		admin_footer();
	}
	else
	{
		$serverinfo=getenv('OS').' / php v'.phpversion();
		$dbversion=$dblink->version();
		if(@ini_get('file_uploads'))
		{
			$fileupload = $lang['yes'].': file '.ini_get('upload_max_filesize').' - form '.ini_get('post_max_size');
		}
		else
		{
			$fileupload = '<font color="red">'.$lang['no'].'</font>';
		}
		$dbsize = 0;
		$query = $dblink->query("SHOW TABLE STATUS LIKE '$tablepre%'", 'SILENT');
		while($table = $dblink->fetch_array($query))
		{
			$dbsize += $table['Data_length'] + $table['Index_length'];
		}
		$dbsize = $dbsize ? sizecount($dbsize) : $lang['unknown'];
	
		$attachsize = dir_size('./attachments/');
		$attachsize = is_numeric($attachsize) ? sizecount($attachsize) : $lang['unknown'];
	
		admin_header();
?>
		<br /><br />
		<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
		<tr><td>
			<table border="0" cellspacing="0" cellpadding="4" width="100%">
			<tr class="header"><td colspan="2"><?php echo $lang['home_sys_info']?></td></tr>
			<tr bgcolor="#FFFFFF"><td width="45%"><?php echo $lang['home_environment']?></td><td><?php echo $serverinfo?></td></tr>
			<tr bgcolor="#F8F8F8"><td><?php echo $lang['home_database']?></td><td><?php echo $dbversion?></td></tr>
			<tr bgcolor="#FFFFFF"><td><?php echo $lang['home_upload_perm']?></td><td><?php echo $fileupload?></td></tr>
			<tr bgcolor="#F8F8F8"><td><?php echo $lang['home_database_size']?></td><td><?php echo $dbsize?></td></tr>
			<tr bgcolor="#FFFFFF"><td><?php echo $lang['home_attach_size']?></td><td><?php echo $attachsize?></td></tr>
			</table>
		</td></tr>
		</table>
		<br />
		<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
		<tr><td>
			<table border="0" cellspacing="0" cellpadding="4" width="100%">
			<tr class="header"><td colspan="2"><?php echo $lang['home_dev']?></td></tr>
			<tr bgcolor="#FFFFFF"><td width="45%"><?php echo $lang['home_dev_copyright']?></td><td class="smalltxt"><a href="http://www.cyask.com" target="_blank">cyask</a></td></tr>
			<tr bgcolor="#FFFFFF"><td><?php echo $lang['home_dev_skins']?></td><td class="smalltxt"><a href="http://www.cyask.com" target="_blank">cyask</a></td></tr>
			<tr bgcolor="#FFFFFF"><td><?php echo $lang['home_dev_project_site']?></td><td class="smalltxt"><a href="http://www.cyask.com" target="_blank">www.cyask.com</a></td></tr>
			<tr bgcolor="#FFFFFF"><td><?php echo $lang['home_dev_community']?></td><td class="smalltxt"><a href="http://www.cyask.com" target="_blank">www.cyask.com</a></td></tr>
			</table>
		</td></tr>
		</table>
		<?php
		admin_footer();
		exit();
	}
}
elseif($admin_action == 'login')
{
	//
}
elseif($admin_action == 'logout_sys')
{
	clear_cookies();
	set_cookie('adminhash','');
	
	echo "<script type=\"text/javascript\">top.location.href=\"./\";</script>"; 
	exit;
}
else
{
	if($cyask_adminid == 1)
	{
		if($admin_action == 'sort_list' || $admin_action == 'sort_add' || $admin_action == 'sort_edit' || $admin_action=='sort_merge' || $admin_action=='sort_del')
		{
			$admin_script = 'sort_manage';
		}
		elseif($admin_action == 'ques_sort' || $admin_action == 'ques_nosolve' || $admin_action == 'ques_solve' || $admin_action == 'ques_vote' || $admin_action == 'ques_intro' || $admin_action == 'ques_list' || $admin_action == 'ques_edit' || $admin_action == 'ques_del' || 
		$admin_action == 'ques_top' || $admin_action == 'ques_close')
		{
			$admin_script = 'ques_manage';
		}
		elseif($admin_action == 'ques_answer' || $admin_action == 'answer_edit' || $admin_action == 'answer_del' || $admin_action == 'answer_search' || $admin_action == 'answer_response')
		{
			$admin_script = 'answer_manage';
		}
		elseif($admin_action == 'user_list' || $admin_action == 'manager_list' || $admin_action == 'manager_add' || $admin_action == 'manager_edit' || $admin_action == 'user_edit' || $admin_action == 'user_grade_manage' ||  $admin_action == 'user_score_manage' || $admin_action == 'user_del' || $admin_action == 'user_find')
		{
			$admin_script = 'user_manage';
		}
		elseif($admin_action == 'db_export' || $admin_action == 'db_import' || $admin_action == 'db_optimize' || $admin_action == 'db_down' || $admin_action == 'db_runquery')
		{
			$admin_script = 'database_manage';
		}
		elseif($admin_action == 'announcement' || $admin_action == 'announcement_add' || $admin_action == 'announcement_add_submit' || $admin_action == 'announcement_edit' || $admin_action == 'announcement_edit_submit' || $admin_action == 'announcement_del')
		{
			$admin_script = 'announcement_manage';
		}
		elseif($admin_action == 'var_setting' || $admin_action == 'setting_edit')
		{
			$admin_script = 'setting_manage';
		}
		else
		{
			exit("admin.php error");
		}

	}
	else if($cyask_adminid == 2)
	{
		
		if($admin_action == 'ques_sort' || $admin_action == 'ques_intro' || $admin_action == 'ques_list' || $admin_action == 'ques_edit' || $admin_action == 'ques_del' || $admin_action == 'ques_top' || $admin_action == 'ques_close' || $admin_action == 'knowledge_share')
		{
			$admin_script = 'ques_manage';
		}
		elseif($admin_action == 'ques_answer' || $admin_action == 'answer_edit' || $admin_action == 'answer_del' || $admin_action == 'answer_search')
		{
			$admin_script = 'answer_manage';
		}
		else
		{
			exit("admin.php error");
		}

	}
	
	if($admin_script)
	{
		include_once ('./admin/'.$admin_script.'.php');
	}
	else
	{
		admin_header();
		admin_msg('noaccess');
		admin_footer();
	}
}

function admin_header()
{
	global $charset;
	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset='.$charset.'">
	<style type="text/css">
<!--
a			{ text-decoration: none; color: #003366 }
a:hover			{ text-decoration: underline }
body			{ scrollbar-base-color: #F8F8F8; scrollbar-arrow-color: #698CC3; font-size: 12px; background-color: #9EB6D8 }
table			{ font: 12px Tahoma, Verdana; color: #000000 }
input,select,textarea	{ font: 11px Tahoma, Verdana; color: #000000; font-weight: normal; background-color: #F8F8F8 }
form			{ margin: 0; padding: 0}
select			{ font: 11px Arial, Tahoma; color: #000000; font-weight: normal; background-color: #F8F8F8 }
.nav			{ font: 12px Tahoma, Verdana; color: #000000; font-weight: bold }
.nav a			{ color: #000000 }
.header			{ font: 11px Tahoma, Verdana; color: #FFFFFF; font-weight: bold; background-color: #698CC3 }
.header a		{ color: #FFFFFF }
.category		{ font: 11px Arial, Tahoma; color: #000000; background-color: #EFEFEF }
.tableborder	{ background: #D6E0EF; border: 1px solid #698CC3 } 
.singleborder	{ font-size: 0px; line-height: 1px; padding: 0px; background-color: #F8F8F8 }
.smalltxt		{ font: 11px Arial, Tahoma }
.outertxt		{ font: 12px Tahoma, Verdana; color: #000000 }
.outertxt a		{ color: #000000 }
.bold			{ font-weight: bold }
.altbg1			{ background: #F8F8F8 }
.altbg2			{ background: #FFFFFF }
.maintable		{ width: 99%; background-color: #FFFFFF }
-->
</style>
<script type="text/javascript">
function deleteit()
{
	if( !confirm("你确定要删除该信息吗？")) return false;
	else return true;
}
function deleteall()
{
	if( !confirm("你确定要批量删除所有信息吗？")) return false;
	else return true;
}
function checkAll(e, itemName)
{ 
	var aa = document.getElementsByName(itemName); 
	for (var j=0; j<aa.length; j++)
	aa[j].checked = e.checked; 
}
</script>
</head>
<body background-color: #9EB6D8 text=#000000 leftmargin=10 topmargin=10>
<br />';
}

function admin_msg($message, $url_forward = '', $msgtype = 'message', $extra = '')
{
	extract($GLOBALS, EXTR_SKIP);
	global $lang;
	eval("\$message = \"".(isset($msglang[$message]) ? $msglang[$message] : $message)."\";");

	if($msgtype == 'form')
	{
		$message = "<form method=\"post\" action=\"$url_forward\">".
			"<br><br><br>$message$extra<br><br><br><br>\n".
        		"<input type=\"submit\" name=\"confirmed\" value=\"$lang[ok]\"> &nbsp; \n".
       			"<input type=\"button\" value=\"$lang[cancel]\" onClick=\"history.go(-1);\"></form><br>";
	}
	else
	{
		if($url_forward)
		{
			$message .= "<br><br><br><a href=\"$url_forward\">$lang[message_redirect]</a>";
			$url_forward = transsid($url_forward);
			$message .= "<script>setTimeout(\"redirect('$url_forward');\", 1250);</script>";
		}
		elseif(strpos($message, $lang['return']))
		{
			$message .= "<br><br><br><a href=\"javascript:history.go(-1);\" class=\"mediumtxt\">$lang[message_return]</a>";
		}
		$message = "<br><br><br>$message$extra<br><br>";
	}
	
echo "<br /><br /><br /><br /><br />
<table cellspacing=1 cellpadding=0 width=80% align=center class=tableborder>
<tr class=header><td height=25>&nbsp;&nbsp;$lang[cyask_message]</td></tr>
<tr><td bgcolor=#FFFFFF align=center>
	<table border=0 width=90% cellspacing=0 cellpadding=0>
	<tr><td width=100% align=center>$message<br /><br /></td></tr>
	</table>
</td></tr>
</table>
<br /><br />";
}

function admin_login($backaction = '')
{
	global $lang;
	
	$formhash = form_hash();
	
	print<<<END
	<br /><br /><br /><br /><br /><br />
	<form method="post" name="loginForm" action="admin.php">
	<table cellspacing="1" cellpadding="2" width="60%" align="center" class="tableborder">
		<tr class="header"><td colspan="2">$lang[safecode_required]</td></tr>
		<tr><td class="altbg1" height=10 colspan="2">&nbsp;</td></tr>
		<tr><td class="altbg1" width="25%">&nbsp;$lang[username]:</td><td class="altbg2">
		<input type="text" name="username" size="25" value="$cyask_user" /></td></tr>
		<tr><td class="altbg1" width="25%">&nbsp;$lang[password]:</td><td class="altbg2">
		<input type="password" name="password" size="25" />
		<input type="hidden" name="admin_action" value="login" />
		<input type="hidden" name="formhash" value="$formhash" />
		<input type="hidden" name="backaction" value="$backaction" />
		</td></tr>
		<tr valign="middle"><td class="altbg1" width="25%" height="35">&nbsp;</td><td class="altbg2">
		<input type="submit" name="login_submit" value="$lang[submit]">
		</td></tr>
	</table>
	</form>
	<br /><br />
END;
}

function admin_footer()
{
	global $version;
	echo "<br><br><hr size=0 noshade color=#698CC3 width=98%>
	<center>
	<font style=\"font-size: 11px; font-family: Tahoma, Verdana, Arial\">
	Powered by <a href=\"http://www.cyask.com\" target=\"_blank\" style=\"color: #000000\"><b>Cyask.com</b> $version</a> &nbsp;&copy; 2006-2008</font></center>
	</body></html>";
	exit;
}
?>