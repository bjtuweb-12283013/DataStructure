<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'login');
require './include/common.inc.php';

$url=empty($_GET['url']) ? $_POST['url'] : $_GET['url'];
if($command=='login')
{
	if($cyask_uid)
	{
		$url=empty($url) ? './' : $url;
		show_message('login_succeed', $url);
	}
	
	if(check_submit($_POST['loginsubmit'], $_POST['formhash']))
	{
		$cyask_user = trim($_POST['username']);
		$cyask_user = daddslashes($cyask_user);
		$md5passwd = md5($_POST['password']);
		
		$query = $dblink->query("SELECT uid,password FROM {$tablepre}member WHERE username='$cyask_user'");
		$rows =  $dblink->num_rows($query);
		if($rows)
		{
			$members 	= $dblink->fetch_array($query);
			$cyask_uid	= $members['uid'];
			$cyask_pw	= $members['password'];
			
			if($cyask_pw == $md5passwd)
			{
				$dblink->query("UPDATE {$tablepre}member SET lastlogin='$timestamp' WHERE uid='$members[uid]'");
				
				$url=empty($url) ? './' : $url;
				$cookietime = $_POST['cookietime'] ? 86400 * 30 : 0;
				set_cookie('compound', authcode("$cyask_uid\t$cyask_user\t$cyask_pw", 'ENCODE', $cyask_key), $cookietime);
				set_cookie('styleid', $styleid, $cookietime);
			
				show_message('login_succeed_member', $url);
			}
			else
			{
				$url='login.php?url='.$url;
				show_message('login_password_error', $url);
			}
		}
		else
		{
			$url='login.php?url='.$url;
			show_message('login_invalid', $url);
		}
	}
	else
	{
		exit(url_error);
	}
}
else if($command == 'logout')
{
	clear_cookies();

	$url = empty($url) ? './' : $url;
	
	show_message('logout_succeed', $url);

}
else
{
	include template('login');
}
?>