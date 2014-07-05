<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['Id'],$_POST['Action']) && is_numeric($_POST['Id']) )
{
	if( $_POST['Action'] == 0 )
	{
		if( $DB->query("DELETE FROM `".$table_apply."` WHERE `aid`=".$_POST['Id']) )
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	if( $_POST['Action'] == 1 )
	{
		$applyArr = $DB->fetch_one_array("SELECT * FROM `".$table_apply."` WHERE `aid`=".$_POST['Id']);

		$moderator = $DB->fetch_one("SELECT `moderator` FROM `".$table_forum."` WHERE `fid`=".$applyArr['fid']);

		$exp_moderator = explode("|",$moderator);

		$master = "";

		if( !empty($moderator) )
		{
			for($i=0;$i<count($exp_moderator);$i++)
			{
				$expModerator = explode(",",$exp_moderator[$i]);

				if( $expModerator[0] != $applyArr['uid'] )
				{
					$master .= $expModerator[0].",".$expModerator[1]."|";
				}
			}
		}

		if( $applyArr['type'] == 0 )
		{
			$master = substr($master,0,-1);

			if( $DB->query("UPDATE `".$table_forum."` SET `moderator`='".$master."' WHERE `fid`=".$applyArr['fid']) )
			{
				$dSql = "DELETE FROM `".$table_apply."` WHERE ";

				$DB->query($dSql."`aid`=".$_POST['Id']);

				$DB->query($dSql."`type`=1 AND `uid`=".$applyArr['uid']." AND `fid`=".$applyArr['fid']);

				if( $DB->fetch_one("SELECT `groupid` FROM `".$table_member."` WHERE `uid`=".$applyArr['uid']) <= 4 )
				{
					$cSql = "SELECT COUNT(`aid`) FROM `".$table_apply."`";

					if( $DB->fetch_one($cSql." WHERE `type`=1 AND `uid`=".$applyArr['uid']." AND `dispose`=1") == 0 )
					{
						$DB->query("UPDATE `".$table_member."` SET `groupid`=1 WHERE `uid`=".$applyArr['uid']);
					}
				}

				echo "1";
			}
		}

		if( $applyArr['type'] == 1 )
		{
			if( empty($moderator) )
			{
				$master = $applyArr['uid'].",".$applyArr['uname'];
			}
			else
			{
				$master .= $applyArr['uid'].",".$applyArr['uname'];
			}

			if( $DB->query("UPDATE `".$table_forum."` SET `moderator`='".$master."' WHERE `fid`=".$applyArr['fid']) )
			{
				if( $DB->fetch_one("SELECT `groupid` FROM `".$table_member."` WHERE `uid`=".$applyArr['uid']) < 4 )
				{
					$DB->query("UPDATE `".$table_member."` SET `groupid`=4 WHERE `uid`=".$applyArr['uid']);
				}

				$DB->query("UPDATE `".$table_apply."` SET `dispose`=1 WHERE `aid`=".$_POST['Id']);

				echo "1";
			}
		}
	}

	$DB->close();
	
	exit;
}

$where = "WHERE `type`=1 AND `dispose`=0";

if( isset($_GET['list']) && $_GET['list'] == "resign" )
{
	$where = "WHERE `type`=0 AND `dispose`=0";
}

$applyArr = $QA->getApply($where,$page,"30");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("bm_apply.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'applyArr',  $applyArr );
			 
$tmp->output();
?>