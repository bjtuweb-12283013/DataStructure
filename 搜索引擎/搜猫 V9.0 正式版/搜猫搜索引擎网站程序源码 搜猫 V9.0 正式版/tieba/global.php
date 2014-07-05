<?php
error_reporting(E_ALL);

header("content-Type: text/html; charset=utf-8");

if ( ini_get( 'zlib.output_compression' ) )
{
	if ( ini_get( 'zlib.output_compression_level' ) != 5)
	{
		ini_set( 'zlib.output_compression_level', '5' );
	}
	ob_start();
}
else
{
	if( isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strstr($_SERVER['HTTP_ACCEPT_ENCODING'],"gzip") )
	{
		ob_start("ob_gzhandler");
	}
	else
	{
		ob_start();
	}
}

require(dirname(__FILE__)."/database/config_site.php");

require(dirname(__FILE__)."/database/config_mysql.php");

require(dirname(__FILE__)."/database/config_secure.php");

require(dirname(__FILE__)."/database/config_group.php");

require(dirname(__FILE__)."/database/config_mail.php");

require(dirname(__FILE__)."/class/class_Mysql.php");

require(dirname(__FILE__)."/class/class_Xxtea.php");

require(dirname(__FILE__)."/class/class_Discuss.php");

require(dirname(__FILE__)."/function.php");

ini_set('date.timezone',$site_timezone);

if( isLogin() )
{
	$loginArr = array("state"=>"1","uid"=>$_COOKIE['userId'],"name"=>$_COOKIE['userName'],"group"=>$_COOKIE['userGroup']);
}
else
{
	$loginArr = array("state"=>"0","uid"=>"0","name"=>getTouristName(),"group"=>0);
}

if( !isset( $userGroup[$loginArr['group']] ) )
{
	$loginArr['group'] = 0;
}

if( isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 )
{
	$page = intval($_GET['page']);
}
else
{
	$page = "1";
}

$DB = new DB_MySQL;

$TB = new DiscussAction;
?>