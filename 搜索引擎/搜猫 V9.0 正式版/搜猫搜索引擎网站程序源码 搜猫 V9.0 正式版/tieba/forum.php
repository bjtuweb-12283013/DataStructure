<?php
require(dirname(__FILE__)."/global.php");

if( !isset($_GET['fid']) || !is_numeric($_GET['fid']) || $_GET['fid'] < 1 )
{
	header("location:./");
}
else
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$ForumArr = $TB->getForumInfo($_GET['fid']);

	if( empty($ForumArr['fid']) )
	{
		header("location:./");
	}
	else
	{
		$digest = false;

		if( isset($_GET['digest']) && $_GET['digest'] == 1 )
		{
			$digest = true;
		}

		$TopicArr = $TB->getForumTopic($ForumArr['fid'],$page,$per_topic_num,$digest);

		$NewTopic = $TB->getNewTopic($ForumArr['fid']);

		if($digest)
		{
			$TopicNum = $TB->getForumTopicNum($ForumArr['fid']);
		}
		else
		{
			$TopicNum = $TopicArr['Total'];
		}

		$ReplyNum = $TB->getForumReplyNum($ForumArr['fid']);

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

		$tmp = template("forum.html");
		 
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
		 
		$tmp->assign( 'ForumArr', $ForumArr );
		 
		$tmp->assign( 'Digest', $digest );
		 
		$tmp->assign( 'TopicArr', $TopicArr );
		 
		$tmp->assign( 'NewTopic', $NewTopic );
		 
		$tmp->assign( 'TopicNum', $TopicNum );
		 
		$tmp->assign( 'ReplyNum', $ReplyNum );
		 
		$tmp->assign( 'isModerator', $isModerator );
		 
		$tmp->assign( 'groupArr', $groupArr );

		$tmp->assign( 'faceArr', $faceDatabase );
		 
		$tmp->output();
	}

	$DB->close();
}

ob_end_flush();
?>