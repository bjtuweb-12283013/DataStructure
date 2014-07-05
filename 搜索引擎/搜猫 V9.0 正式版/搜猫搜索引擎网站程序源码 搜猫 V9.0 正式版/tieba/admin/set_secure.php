<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['cookie_path'],$_POST['cookie_domain'],$_POST['cookie_key_login'],$_POST['cookie_key_admin']) )
{
	$cookie_path = stripslashes(trim($_POST['cookie_path']));

	$cookie_domain = strtolower(trim($_POST['cookie_domain']));

	$cookie_key_login = stripslashes(trim($_POST['cookie_key_login']));

	$cookie_key_admin = stripslashes(trim($_POST['cookie_key_admin']));

	if( empty($cookie_path) || substr($cookie_path,-1) != "/" || substr($cookie_path,0,1) != "/" || strpos($cookie_path,'"') )
	{
		die("<script>alert('Cookie 路径不正确');</script>");
	}

	if( empty($cookie_domain) || substr($cookie_domain,0,1) != "." )
	{
		die("<script>alert('Cookie 作用域不正确');</script>");
	}

	if( empty($cookie_key_login) || empty($cookie_key_admin) || strpos($cookie_key_login,'"') || strpos($cookie_key_admin,'"') )
	{
		die("<script>alert('密钥不合法');</script>");
	}

	$config_str = "<?php";

	$config_str .= "\n";

	$config_str .= '$cookie_path		= "'.$cookie_path.'";';

	$config_str .= "\n\n";

	$config_str .= '$cookie_domain		= "'.$cookie_domain.'";';

	$config_str .= "\n\n";

	$config_str .= '$cookie_key_login	= "'.$cookie_key_login.'";';

	$config_str .= "\n\n";

	$config_str .= '$cookie_key_admin	= "'.$cookie_key_admin.'";';

	$config_str .= "\n";

	$config_str .= '?>';

	$configFile = dirname(__FILE__)."/../database/config_secure.php";

	if( @is_writable($configFile) )
	{
		$handle = @fopen($configFile, 'w');

		if ( @flock($handle, LOCK_EX) )
		{
			@fwrite($handle, $config_str);

			@flock($handle, LOCK_UN);
		}
			
		@fclose($handle);

		die("<script>alert('更新成功');top.location.href='../login.php?do=logout';</script>");
	}
	else
	{
		die("<script>alert('config_secure.php 文件不可写');</script>");
	}
}

$tmp = & myTpl("set_secure.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'cookie_path',  $cookie_path );
			 
$tmp->assign( 'cookie_domain',  $cookie_domain );
			 
$tmp->assign( 'cookie_key_login',  $cookie_key_login );
			 
$tmp->assign( 'cookie_key_admin',  $cookie_key_admin );
			 
$tmp->output();
?>