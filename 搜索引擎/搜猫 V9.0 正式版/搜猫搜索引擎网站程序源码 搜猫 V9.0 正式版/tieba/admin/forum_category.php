<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['fid'],$_POST['aid']) && is_numeric($_POST['fid']) )
{
	if( $_POST['aid'] == "1" )
	{
		$updateArr['cid'] = $DB->fetch_one("SELECT `cid` FROM `".$table_class."` WHERE `fid`=".$_POST['fid']);

		if( $DB->query( $DB->update_sql("`".$table_forum."`",$updateArr,"`fid`=".$_POST['fid']) ) )
		{
			$DB->query("DELETE FROM `".$table_class."` WHERE `fid`=".$_POST['fid']);
		}
	}

	if( $_POST['aid'] == "0" )
	{
		$DB->query("DELETE FROM `".$table_class."` WHERE `fid`=".$_POST['fid']);
	}

	$DB->close();

	echo "1";

	exit;
}

$forumArr = $QA->getForumCategory($page,"30");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("forum_category.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'forumArr',  $forumArr );
			 
$tmp->output();
?>