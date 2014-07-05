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
			if( isset($_GET['do'],$_POST['intro']) && $_GET['do'] == "update" )
			{
				$intro = filterCode($_POST['intro']);

				if( getStrlen($intro) > 90 )
				{
					echo "<script>alert('吧简介不能超过90个字');</script>";
				}
				else
				{
					$forumInfo['synopsis'] = $intro;

					if( $DB->query( $DB->update_sql("`".$table_forum."`",$forumInfo,"`fid`=".$ForumArr['fid']) ) )
					{
						echo "<script>alert('更新成功！');</script>";
					}
					else
					{
						echo "<script>alert('数据库繁忙，请重新提交！');</script>";
					}
				}
			}
			else
			{
				$tmp = template("forum_set.html");
				 
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

				$tmp->output();
			}
		}
	}

	$DB->close();
}

ob_end_flush();
?>