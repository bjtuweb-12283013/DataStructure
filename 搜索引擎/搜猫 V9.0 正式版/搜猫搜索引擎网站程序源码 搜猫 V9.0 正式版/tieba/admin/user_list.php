<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

$where = "";

if( isset($_GET['te'],$_GET['wd']) && !empty($_GET['wd']) )
{
	$keyword = strAddslashes(strtolower(trim($_GET['wd'])));

	if( $_GET['te'] == "uid" && is_numeric($keyword) && $keyword >= 1 )
		$where = "WHERE `uid` = ".$keyword;

	if( $_GET['te'] == "name" )
		$where = "WHERE lower(`name`) LIKE '".$keyword."%'";

	if( $_GET['te'] == "email" && emailcheck($keyword) )
		$where = "WHERE `email` = '".$keyword."'";
}

$MemberArr = $QA->getMember($where,$page,30);

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("user_list.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'MemberArr',  $MemberArr );
			 
$tmp->output();
?>