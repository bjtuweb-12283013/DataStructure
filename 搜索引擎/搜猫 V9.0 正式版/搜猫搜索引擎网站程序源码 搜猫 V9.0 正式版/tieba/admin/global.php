<?php
error_reporting(E_ALL);

set_time_limit(0);

header("content-Type: text/html; charset=utf-8");

require(dirname(__FILE__)."/../database/config_mysql.php");

require(dirname(__FILE__)."/../database/config_secure.php");

require(dirname(__FILE__)."/../database/config_site.php");

require(dirname(__FILE__)."/../database/config_group.php");

require(dirname(__FILE__)."/../database/config_mail.php");

require(dirname(__FILE__)."/../function.php");

require(dirname(__FILE__)."/../class/class_Mysql.php");

require(dirname(__FILE__)."/../class/class_Xxtea.php");

require(dirname(__FILE__)."/include/config.php");

require(dirname(__FILE__)."/include/function.php");

require(dirname(__FILE__)."/class/class_Query.php");

ini_set('date.timezone',$site_timezone);

if( !adminLogin() )
{
	header("location:../");

	exit;
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

$QA = new QueryAction;
?>