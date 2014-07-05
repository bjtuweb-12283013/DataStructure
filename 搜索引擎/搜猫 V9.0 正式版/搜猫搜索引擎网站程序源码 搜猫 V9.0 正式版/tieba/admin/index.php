<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['do']) && $_GET['do'] == "logout" )
{
	setcookie("adminSecure","",time()-36000,$cookie_path,$cookie_domain);

	header("location:../");

	exit;
}

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');

$mysql_version = $DB->version();

$dbsize = 0;

$tables = $DB->fetch_all("SHOW TABLE STATUS");

foreach($tables as $table)
{
	if( substr($table['Name'],0,strlen($mysql_prefix)) == $mysql_prefix )
	{
		$dbsize += $table['Data_length'] + $table['Index_length'];
	}
}

$DB->close();

$systemInfo = array(
					"root"		=> isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '',
					"os"		=> PHP_OS,
					"web"		=> explode("/",$_SERVER['SERVER_SOFTWARE']),
					"php"		=> PHP_VERSION,
					"mysql"		=> $mysql_version,
					"dbsize"	=> filesize_format($dbsize)
					);

$tmp = & myTpl("index.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'systemInfo',  $systemInfo );
			 
$tmp->output();
?>