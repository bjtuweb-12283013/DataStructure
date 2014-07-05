<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['do']) && $_GET['do'] == "logout" )
{
	foreach ($_COOKIE as $key=>$val)
	{
		setcookie($key,'',time()-3600,$cookie_path,$cookie_domain);
	}

	if( isset($_SERVER['HTTP_REFERER']) )
	{
		$backUrl = $_SERVER['HTTP_REFERER'];
	}
	else
	{
		$backUrl = "./";
	}

	header("location:".$backUrl);
}
else if( isset($_GET['do']) && $_GET['do'] == "login" )
{
	if( isset($_POST['login-user'],$_POST['login-pwd']) )
	{
		$loginUser = strAddslashes(trim($_POST['login-user']));

		$loginPwd = stripslashes(trim($_POST['login-pwd']));

		if( strlen($loginUser) < 2 || strlen($loginUser) > 45 || strlen($loginPwd) < 6 || strlen($loginPwd) > 18)
		{
			echo "0 用户名或者密码不符合要求";
		}
		else
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			if( !emailcheck($loginUser) )
			{
				$LoginType = "lower(`name`)";
			}
			else
			{
				$LoginType = "`email`";
			}

			$userArr = $TB->getMemberInfo($LoginType,strtolower($loginUser));

			if( !empty($userArr['uid']) )
			{
				if( $userArr['password'] == md5($loginPwd) )
				{
					$loginTime = time();

					$loginIp = getClientIP();

					loginCookie($userArr['uid'],$userArr['name'],$userArr['groupid'],$loginIp,$loginTime);
					
					$loginInfo['securekey'] = createSecureKey(10);

					$loginInfo['lastdate'] = $loginTime;

					$loginInfo['lastip'] = $loginIp;

					if( $userArr['lastdate'] != date("Y.m.d") )
					{
						$loginInfo['integral'] = array("`integral`+1");
					}

					$DB->query( $DB->update_sql("`".$table_member."`",$loginInfo,"`uid`=".$userArr['uid']) );

					echo "1 登录成功";
				}
				else
				{
					echo "0 您输入的密码不正确";
				}
			}
			else
			{
				echo "0 通行证账号不存在";
			}

			$DB->close();
		}
	}
}
else
{
	$tmp = template("login.html");

	$tmp->assign( 'siteName',  $site_name );
	 
	$tmp->output();
}

ob_end_flush();
?>