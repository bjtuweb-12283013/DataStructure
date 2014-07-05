<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

$where1 = "";

$where2 = "";

if( isset($_GET['name']) && !empty($_GET['name']) )
{
	$name = trim(strtolower(strAddslashes($_GET['name'])));

	$where1 = "WHERE lower(`name`) LIKE '".$name."%'";

	$where2 = "WHERE lower(I.`name`) LIKE '".$name."%'";
}

$forumArr = $QA->getForumList($where1,$where2,$page,"30");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("forum_list.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'forumArr',  $forumArr );
			 
$tmp->output();
?>