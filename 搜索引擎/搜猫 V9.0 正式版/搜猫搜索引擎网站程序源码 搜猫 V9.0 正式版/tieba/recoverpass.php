<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['do']) && $_GET['do'] == "send" )
{
	if( isset($_POST['username'],$_POST['useremail']) )
	{
		$username = strAddslashes(trim($_POST['username']));

		$checkname = usernameCheck($username);

		$email = strtolower(trim($_POST['useremail']));

		if( !empty($checkname) || !emailcheck($email) )
		{
			echo "1 用户昵称或者电子邮件不正确。";
		}
		else
		{
			$newKey = createSecureKey(9);

			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$userArr = $TB->getMemberInfo("lower(`name`)",strtolower($username));

			if( $userArr['email'] == $email )
			{
				$secureArr['securekey'] = $newKey;

				$DB->query( $DB->update_sql("`".$table_member."`",$secureArr,"`uid`=".$userArr['uid']) );

				$mail_title = $userArr['name']."，您的临时识别码";

				$mail_body = "您的临时识别码：".$newKey;

				if( sendEmail($userArr['email'], $mail_title, $mail_body) )
				{
					echo "0 ".$userArr['uid'];
				}
				else
				{
					echo "1 识别码发送失败！请重试。";
				}
			}
			else
			{
				echo "1 用户昵称与电子邮件不匹配。";
			}

			$DB->close();
		}
	}
}
else if( isset($_GET['do']) && $_GET['do'] == "reset" )
{
	if( isset($_POST['safetycode'],$_POST['newpwd'],$_POST['repwd'],$_POST['backuid']) )
	{
		$safetycode = stripslashes(trim($_POST['safetycode']));
		
		if( strlen($safetycode) < 8 || strlen($safetycode) > 10 )
		{
			die("1 识别码不符合要求。");
		}

		$newpwd = stripslashes(trim($_POST['newpwd']));

		$repwd = stripslashes(trim($_POST['repwd']));

		if( strlen($newpwd) < 6 || strlen($newpwd) > 18 )
		{
			die("1 密码长度应控制在6至18个字符之间。");
		}

		if( $newpwd != $repwd )
		{
			die("1 两次输入的密码不一致。");
		}

		$userid = intval($_POST['backuid']);

		if( $userid < 1 )
		{
			die("2 操作异常，请重新取回密码！");
		}

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$userArr = $TB->getMemberInfo("`uid`",$userid);

		if( $userArr['securekey'] == $safetycode )
		{
			$loginTime = time();

			$loginIp = getClientIP();

			$newInfo['password'] = md5($newpwd);

			$newInfo['securekey'] = createSecureKey(10);

			$newInfo['lastdate'] = $loginTime;

			$newInfo['lastip'] = $loginIp;

			if( $DB->query( $DB->update_sql("`".$table_member."`",$newInfo,"`uid`=".$userArr['uid']) ) )
			{
				loginCookie($userArr['uid'],$userArr['name'],$userArr['groupid'],$loginIp,$loginTime);

				echo "0 密码修改成功，请牢记您的新密码！";
			}
			else
			{
				echo "1 数据库繁忙，请重试！";
			}
		}
		else
		{
			echo "1 识别码不正确！";
		}

		$DB->close();
	}
}
else
{
	$tmp = template("recoverpass.html");
	 
	$tmp->output();
}

ob_end_flush();
?>