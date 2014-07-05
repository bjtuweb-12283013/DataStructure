<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['nickname']) )
{
	$nickname = strAddslashes(trim($_POST['nickname']));

	if( !empty($nickname) )
	{
		$checkname = usernameCheck($nickname);

		if( !empty($checkname) )
		{
			echo "1 ".$checkname;
		}
		else
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$N = $DB->fetch_one("SELECT COUNT(`uid`) FROM `".$table_member."` WHERE lower(`name`)='".strtolower($nickname)."'");

			$DB->close();

			if( $N > 0 )
			{
				echo "1 昵称“".$nickname."”已被注册，换一个吧 ^_^";
			}
			else
			{
				setcookie("TouristName",Xxtea::encrypt($nickname,$cookie_key_login),time()+63072000,$cookie_path,$cookie_domain);
				
				echo "0 成功";
			}
		}
	}
	else
	{
		setcookie("TouristName",'',time()-3600,$cookie_path,$cookie_domain);

		echo "1";
	}
}
else
{
	$tmp = template("anonymity.html");
	
	$tmp->assign( 'loginArr',  $loginArr );
	 
	$tmp->output();
}

ob_end_flush();
?>