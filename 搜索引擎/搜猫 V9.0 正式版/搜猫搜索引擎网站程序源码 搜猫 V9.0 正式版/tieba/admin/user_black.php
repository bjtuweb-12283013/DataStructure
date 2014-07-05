<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['Type']) && !empty($_POST['Type']) )
{
	if( in_array($_POST['Type'],array('expire','id','ip','all')) )
	{
		switch ($_POST['Type'])
		{
			case 'expire':
				$Sql = "DELETE FROM `".$table_black."` WHERE `dateline` < (".time()."-2592000)";
				break;
			case 'id':
				$Sql = "DELETE FROM `".$table_black."` WHERE `uid` > 0";
				break;
			case 'ip':
				$Sql = "DELETE FROM `".$table_black."` WHERE `uid` = 0";
				break;
			case 'all':
				$Sql = "TRUNCATE TABLE `".$table_black."`";
				break;
		}

		$DB->query($Sql);

		$DB->close();

		echo "1";
	}

	exit;
}

if( isset($_POST['deleteId']) && is_numeric($_POST['deleteId']) )
{
	$DB->query("DELETE FROM `".$table_black."` WHERE `bid`=".$_POST['deleteId']);

	$DB->close();

	echo "1";

	exit;
}

if( isset($_POST['uid'],$_POST['uname']) && is_numeric($_POST['uid']) && !empty($_POST['uname']) )
{
	if( $_POST['uid'] > 0 )
	{
		$DB->query("DELETE FROM `".$table_black."` WHERE `uid`=".$_POST['uid']);
	}
	else
	{
		$DB->query("DELETE FROM `".$table_black."` WHERE `uname`='".$_POST['uname']."'");
	}

	$blackInfo['fid'] = 0;

	$blackInfo['uid'] = $_POST['uid'];
	
	$blackInfo['uname'] = $_POST['uname'];
	
	$blackInfo['dateline'] = time();
	
	$blackInfo['adminid'] = $_COOKIE['userId'];
	
	$blackInfo['adminname'] = $_COOKIE['userName'];
	
	$DB->query($DB->insert_sql("`".$table_black."`",$blackInfo));

	$DB->close();

	echo "1";

	exit;
}

$blackListArr = $QA->getBlackList("","",$page,30);

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("user_black.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'blackListArr',  $blackListArr );
			 
$tmp->output();
?>