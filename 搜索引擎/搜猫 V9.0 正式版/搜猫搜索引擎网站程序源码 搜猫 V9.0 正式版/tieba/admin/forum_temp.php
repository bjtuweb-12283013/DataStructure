<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['forumId'],$_POST['actionId']) && is_numeric($_POST['forumId']) && $_POST['forumId'] >= 1 )
{
	if( $_POST['actionId'] == 1 )
	{
		$forumArr = $DB->fetch_one_array("SELECT `name`,`synopsis` FROM `".$table_temp."` WHERE `fid`=".$_POST['forumId']);

		if( !empty($forumArr['name']) )
		{
			$infoArr['cid'] = "0";

			$infoArr['name'] = $forumArr['name'];

			$infoArr['synopsis'] = $forumArr['synopsis'];

			$infoArr['moderator'] = "";

			$infoArr['friend'] = "";

			if( $DB->fetch_one("SELECT COUNT(`fid`) FROM `".$table_forum."` WHERE `name`='".$forumArr['name']."'") == 0 )
			{
				$DB->query( $DB->insert_sql("`".$table_forum."`",$infoArr) );
			}
		}
	}

	$DB->query("DELETE FROM `".$table_temp."` WHERE `fid`=".$_POST['forumId']);

	$DB->close();

	die("1");
}

$where = "";

if( isset($_GET['name']) && !empty($_GET['name']) )
{
	$where = "WHERE lower(`name`) LIKE '".trim(strtolower(strAddslashes($_GET['name'])))."%'";
}

$forumArr = $QA->getForumTemp($where,$page,"30");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("forum_temp.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'forumArr',  $forumArr );
			 
$tmp->output();
?>