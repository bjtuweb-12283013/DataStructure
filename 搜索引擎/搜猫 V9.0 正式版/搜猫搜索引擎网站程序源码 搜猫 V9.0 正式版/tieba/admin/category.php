<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['deleteId']) && is_numeric($_POST['deleteId']) &&  $_POST['deleteId'] >= 1 )
{
	$cId = $_POST['deleteId'];

	$fatherId = $DB->fetch_one("SELECT `fatherid` FROM `".$table_catalog."` WHERE `cid`=".$cId);

	if( $fatherId > 0 )
	{
		if( $DB->query("DELETE FROM `".$table_catalog."` WHERE `cid`=".$cId) )
		{
			$DB->query("UPDATE `".$table_forum."` SET `cid`=0 WHERE `cid`=".$cId);

			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	else
	{
		if( $DB->fetch_one("SELECT COUNT(`cid`) FROM `".$table_catalog."` WHERE `fatherid`=".$cId) == 0 )
		{
			if( $DB->query("DELETE FROM `".$table_catalog."` WHERE `cid`=".$cId) )
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "2";
		}
	}

	$DB->close();

	exit;
}

if( isset($_GET['action'],$_POST['father'],$_POST['name'],$_POST['cid']) && $_GET['action'] == "do" )
{
	$fatherId = $_POST['father'];

	$name = trim(strAddslashes($_POST['name']));

	$cid = $_POST['cid'];

	if( empty($name) || !wordCheck($name) || getStrlen($name) > 15 )
	{
		echo "<script>alert('名称不合法');</script>";
	}
	else
	{
		if( $fatherId > 0 && $DB->fetch_one("SELECT COUNT(`cid`) FROM `".$table_catalog."` WHERE `cid`=".$fatherId) < 1 )
		{
			echo "<script>alert('上级目录不存在');</script>";
		}
		else
		{
			$infoArr['fatherid'] = $fatherId;

			$infoArr['name'] = $name;

			if( empty($cid) )
			{
				$Sql = $DB->insert_sql("`".$table_catalog."`",$infoArr);
			}
			else
			{
				$Sql = $DB->update_sql("`".$table_catalog."`",$infoArr,"`cid`=".$cid);
			}

			if( $DB->query($Sql) )
			{
				echo "<script>alert('操作成功');top.location.reload();</script>";
			}
			else
			{
				echo "<script>alert('数据库繁忙');</script>";
			}
		}
	}

	$DB->close();

	exit;
}

$category = $QA->getCategory();

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("category.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'category',  $category );
			 
$tmp->output();
?>