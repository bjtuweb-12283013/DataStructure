<?php
require(dirname(__FILE__)."/global.php");

if( !isset($_GET['fid']) || !is_numeric($_GET['fid']) || $_GET['fid'] < 1 )
{
	echo "<script>top.location.href='./';</script>";
}
else
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$ForumArr = $TB->getForumInfo($_GET['fid']);

	if( empty($ForumArr['fid']) )
	{
		echo "<script>top.location.href='./';</script>";
	}
	else
	{
		for( $i=0;$i<count($ForumArr['moderator']);$i++  )
		{
			if( $ForumArr['moderator'][$i]['uid'] == $loginArr['uid'] )
			{
				$isModerator = 1;
			}
		}

		if( !isset($isModerator) )
		{
			if( $site_rewrite )
				echo "<script>top.location.href='./bar-".$ForumArr['fid']."-1.html';</script>";
			else
				echo "<script>top.location.href='./forum.php?fid=".$ForumArr['fid']."';</script>";
		}
		else
		{
			if( isset($_GET['do'],$_GET['bid']) && $_GET['do'] == "delete" && is_numeric($_GET['bid']) )
			{
				if( $DB->fetch_one("SELECT `fid` FROM `".$table_black."` WHERE `bid`=".$_GET['bid']) == $ForumArr['fid'] )
				{
					if( $DB->query("DELETE FROM `".$table_black."` WHERE `bid`=".$_GET['bid']) )
					{
						echo "<script>top.location.href=top.location.href;</script>";
					}
					else
					{
						echo "<script>alert('数据库繁忙，请重新提交！');</script>";
					}
				}
			}
			else
			{
				$getType = (isset($_GET['show']) && $_GET['show'] == "ip") ? 1 : 0;

				$getWhere = ($getType) ? "=" : ">";

				$blackListArr = $TB->getBlackList("`uid`".$getWhere."0 AND (`fid`=".$ForumArr['fid']." OR `fid`=0)",$page,30);

				$tmp = template("forum_blacklist.html");
				 
				$tmp->assign( 'codeName',  $code_name );
				 
				$tmp->assign( 'codeVersion',  $code_version );
				 
				$tmp->assign( 'siteName',  $site_name );
				 
				$tmp->assign( 'siteDomain',  $site_domain );

				$tmp->assign( 'siteCatalog',  $site_catalog );
				 
				$tmp->assign( 'siteIcp',  $site_icp );
		 
				$tmp->assign( 'searchWord',  $ForumArr['name'] );
		 
				$tmp->assign( 'searchType',  "1" );
				 
				$tmp->assign( 'loginArr',  $loginArr );
				 
				$tmp->assign( 'ForumArr',  $ForumArr );
				 
				$tmp->assign( 'getType',  $getType );
				 
				$tmp->assign( 'blackListArr',  $blackListArr );

				$tmp->output();
			}
		}
	}

	$DB->close();
}

ob_end_flush();
?>