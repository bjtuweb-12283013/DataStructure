<?php
require(dirname(__FILE__)."/global.php");

if( $loginArr['group'] >= 6 )
{
	require(dirname(__FILE__)."/admin/include/function.php");
	
	if( isset($_GET['do'],$_POST['login-pwd']) && $_GET['do'] == "login" )
	{
		$loginPwd = stripslashes(trim($_POST['login-pwd']));

		if( strlen($loginPwd) < 6 || strlen($loginPwd) > 18)
		{
			echo "0 密码不符合要求";
		}
		else
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');
			
			$Password = $DB->fetch_one("SELECT `password` FROM `".$table_member."` WHERE `uid`=".$loginArr['uid']);

			$DB->close();

			if( $Password == md5($loginPwd) )
			{
				adminCookie();

				echo "1 登录成功";
			}
			else
			{
				echo "0 您输入的密码不正确";
			}
		}
	}
	else
	{
		if( adminLogin() )
		{
			header("location:./admin/");
		}
		else
		{
			$tmp = template("admin.html");
						 
			$tmp->assign( 'codeName',  $code_name );
						 
			$tmp->assign( 'codeVersion',  $code_version );
						 
			$tmp->assign( 'siteName',  $site_name );
						 
			$tmp->assign( 'siteDomain',  $site_domain );

			$tmp->assign( 'siteCatalog',  $site_catalog );
						 
			$tmp->assign( 'siteIcp',  $site_icp );
						 
			$tmp->output();
		}
	}
}
else
{
	header("location:./");
}

ob_end_flush();
?>