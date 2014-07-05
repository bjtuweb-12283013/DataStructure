<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['id'],$_POST['do']) && is_numeric($_POST['id']) && $_POST['do'] == "delete" )
{
	$DB->query("DELETE FROM `".$table_report."` WHERE `rid`=".$_POST['id']);

	echo "1";
}
else
{
	$reportArr = $QA->getReport($page,"30");

	$tmp = & myTpl("report_list.html");

	$tmp->assign( 'codeName',  $code_name );
				 
	$tmp->assign( 'codeVersion',  $code_version );
				 
	$tmp->assign( 'siteName',  $site_name );
				 
	$tmp->assign( 'siteDomain',  $site_domain );
				 
	$tmp->assign( 'siteCatalog',  $site_catalog );
				 
	$tmp->assign( 'reportArr',  $reportArr );
				 
	$tmp->output();
}

$DB->close();

unset($DB,$QA);
?>