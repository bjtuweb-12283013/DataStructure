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

	$DB->close();

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
			$tmp = template("forum_abdicate.html");
			 
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

ob_end_flush();
?>