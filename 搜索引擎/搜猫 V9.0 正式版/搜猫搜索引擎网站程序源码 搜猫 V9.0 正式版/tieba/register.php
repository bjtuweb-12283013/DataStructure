<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['do'],$_POST['username'],$_POST['userpwd'],$_POST['repwd'],$_POST['useremail']) && $_GET['do'] == "reg" )
{
	$uname = strAddslashes(trim($_POST['username']));

	$checkname = usernameCheck($uname);

	if( !empty($checkname) )
	{
		die("1 ".$checkname);
	}

	$passwd = stripslashes(trim($_POST['userpwd']));

	$repasswd = stripslashes(trim($_POST['repwd']));

	if( strlen($passwd) < 6 || strlen($passwd) > 18 )
	{
		die("1 密码长度应控制在6至18个字符之间。");
	}

	if( $passwd != $repasswd )
	{
		die("1 两次输入的密码不一致。");
	}

	$email = strtolower(trim($_POST['useremail']));

	if( strlen($email) > 45 || !emailcheck($email) )
	{
		die("1 电子邮件地址不合法。");
	}
	
	$actionTime = time();
	
	$actionIp = getClientIP();
	
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	if( $DB->fetch_one("SELECT COUNT(`bid`) FROM `".$table_black."` WHERE `uname`='".$actionIp."'") != 0 )
	{
		echo "1 很抱歉，系统拒绝了您的注册！请与管理员联系。";
	}
	else
	{
		if( $DB->fetch_one("SELECT COUNT(`uid`) FROM `".$table_member."` WHERE lower(`name`)='".strtolower($uname)."'") != 0 )
		{
			echo "1 用户昵称已被占用";
		}
		else
		{
			if( $DB->fetch_one("SELECT COUNT(`uid`) FROM `".$table_member."` WHERE `email` = '".$email."'") != 0 )
			{
				echo "1 电子邮箱地址已被注册";
			}
			else
			{
				$passport_info['name'] = $uname;
				$passport_info['email'] = $email;
				$passport_info['password'] = md5($passwd);
				$passport_info['securekey'] = createSecureKey(8);
				$passport_info['regdate'] = $actionTime;
				$passport_info['regip'] = $actionIp;
				$passport_info['lastdate'] = $actionTime;
				$passport_info['lastip'] = $actionIp;
				$passport_info['groupid'] = 1;
				
				if( $DB->query($DB->insert_sql("`".$table_member."`",$passport_info)) )
				{
					$user_id = $DB->insert_id();

					loginCookie($user_id,stripslashes($uname),1,$actionIp,$actionTime);

					echo "0 恭喜您，注册成功！";
				}
				else
				{
					echo "1 数据库繁忙，请重新提交！";
				}
			}
		}
	}

	$DB->close();
}
else
{
	$tmp = template("register.html");
	 
	$tmp->output();
}

ob_end_flush();
?>