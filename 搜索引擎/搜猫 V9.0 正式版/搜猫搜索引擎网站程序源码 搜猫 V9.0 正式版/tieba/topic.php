<?php
require(dirname(__FILE__)."/global.php");

if( !isset($_GET['tid']) || !is_numeric($_GET['tid']) || $_GET['tid'] < 1 )
{
	header("location:./");
}
else
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$topicArr = $TB->getTopicInfo($_GET['tid']);

	if( empty($topicArr['tid']) )
	{
		echo "<script>alert('主题帖不存在');location.href='./';</script>";
	}
	else
	{
		$ForumArr = $TB->getForumInfo($topicArr['fid']);

		if( empty($ForumArr['fid']) )
		{
			header("location:./");
		}
		else
		{
			$backPage = 1;
			
			if( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) )
			{
				preg_match("/".$_SERVER['SERVER_NAME']."\/(forum.php\?fid=|bar-)([0-9]+)(&page=|-)([0-9]+)/",$_SERVER['HTTP_REFERER'],$pageArr);

				if( isset($pageArr[4]) && is_numeric($pageArr[4]) && $pageArr[4] >= 1 )
				{
					$backPage = $pageArr[4];
				}
			}

			$isModerator = 0;

			for( $i=0;$i<count($ForumArr['moderator']);$i++  )
			{
				if( $ForumArr['moderator'][$i]['uid'] == $loginArr['uid'] )
				{
					$isModerator = 1;
				}
			}

			if( $loginArr['group'] == 4 && $isModerator != 1 )
			{
				$loginArr['group'] = 2;
			}

			$groupArr = $userGroup[$loginArr['group']];

			$faceDatabase = unserialize(substr(file_get_contents("./database/db.smile.php"),13));

			$postArr = $TB->getTopicPost($topicArr['tid'],$page,$per_post_num);

			$otherTopic = $TB->getAuthorTopic($topicArr['authorid'],$topicArr['tid']);

			$tmp = template("topic.html");
			 
			$tmp->assign( 'codeName', $code_name );
			 
			$tmp->assign( 'codeVersion', $code_version );
			 
			$tmp->assign( 'siteName', $site_name );
			 
			$tmp->assign( 'siteDomain', $site_domain );
			 
			$tmp->assign( 'siteCatalog', $site_catalog );
			 
			$tmp->assign( 'siteIcp', $site_icp );

			$tmp->assign( 'postAnonymous', $post_anonymous );
		 
			$tmp->assign( 'searchWord', $ForumArr['name'] );
		 
			$tmp->assign( 'searchType', "1" );
			 
			$tmp->assign( 'loginArr', $loginArr );

			$tmp->assign( 'topicArr', $topicArr );

			$tmp->assign( 'ForumArr', $ForumArr );

			$tmp->assign( 'backPage', $backPage );
			
			$tmp->assign( 'isModerator', $isModerator );

			$tmp->assign( 'groupArr', $groupArr );

			$tmp->assign( 'faceArr', $faceDatabase );

			$tmp->assign( 'postArr', $postArr );

			$tmp->assign( 'otherTopic', $otherTopic );
			 
			$tmp->output();
		}
	}

	$DB->close();
}

ob_end_flush();
?>