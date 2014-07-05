<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['deleteId']) && !empty($_POST['deleteId']) )
{
	$deleteId = $_POST['deleteId'];

	if( count(explode(",",$deleteId)) > 1 )
	{
		$D = "IN (".$deleteId.")";
	}
	else
	{
		$D = "= ".$deleteId;
	}

	$DB->query("DELETE FROM `".$table_topic."` WHERE `tid` ".$D);

	$DB->query("DELETE FROM `".$table_post."` WHERE `tid` ".$D);

	$DB->query("DELETE FROM `".$table_post2."` WHERE `tid` ".$D);

	$DB->close();

	echo "1";

	exit;
}

$where = "";

if( isset($_GET['wd']) && !empty($_GET['wd']) )
{
	$where = "WHERE `subject` LIKE '".trim(filterCode($_GET['wd']))."%'";
}

$topicArr = $QA->getTopic($where,$page,"30");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("topic_list.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'topicArr',  $topicArr );
			 
$tmp->output();
?>