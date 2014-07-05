<?php
require(dirname(__FILE__)."/global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

if( isset($_POST['deleteId']) && !empty($_POST['deleteId']) )
{
	$idArr = explode(",",$_POST['deleteId']);

	foreach( $idArr as $pId )
	{
		$tArr = $DB->fetch_one_array("SELECT `tid`,`replyfloor` FROM `".$table_post."` WHERE `pid`=".$pId);

		if( $tArr['replyfloor'] == 0 )
		{
			$DB->query("DELETE FROM `".$table_topic."` WHERE `tid`=".$tArr['tid']);
			
			$DB->query("DELETE FROM `".$table_post."` WHERE `tid`=".$tArr['tid']);
			
			$DB->query("DELETE FROM `".$table_post2."` WHERE `tid`=".$tArr['tid']);
		}

		if( $tArr['replyfloor'] > 0 )
		{
			$DB->query("DELETE FROM `".$table_post."` WHERE `pid`=".$pId);

			$delPostNum = $DB->affected_rows("DELETE FROM `".$table_post2."` WHERE `pid`=".$pId);

			if( $delPostNum > 0 )
			{
				$Sql = "SELECT `author`,`authorid`,`authorico`,`dateline` FROM `".$table_post."` WHERE `tid`=".$tArr['tid']." ORDER BY `pid` DESC LIMIT 1";
				
				$lastArr = $DB->fetch_one_array($Sql);
				
				$topicInfo['lasttime'] = $lastArr['dateline'];
				
				$topicInfo['lastauthor'] = $lastArr['author'];
				
				$topicInfo['lastauthorid'] = $lastArr['authorid'];
				
				$topicInfo['lastauthorico'] = $lastArr['authorico'];

				$topicInfo['replies'] = array("`replies`-1");

				$DB->query($DB->update_sql("`".$table_topic."`",$topicInfo,"`tid`=".$tArr['tid']));

				$thisFloor = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `tid`=".$tArr['tid']." AND `pid`<".$pId);

				$thisFloor++;

				$postInfo['replyfloor'] = 1;

				$DB->query($DB->update_sql("`".$table_post."`",$postInfo,"`tid`=".$tArr['tid']." AND `replyfloor`= ".$thisFloor));

				$postInfo['replyfloor'] = array("`replyfloor`-1");

				$DB->query($DB->update_sql("`".$table_post."`",$postInfo,"`tid`=".$tArr['tid']." AND `pid`>".$pId." AND `replyfloor`>".$thisFloor));
			}
		}
	}

	$DB->close();

	echo "1";

	exit;
}

if( isset($_POST['pid'],$_POST['message']) && is_numeric($_POST['pid']) )
{
	$content = filterCode(htmlToUBB($_POST['message']),false);

	$checkContent = checkPostContent($content,22);

	if( $checkContent != "" )
	{
		echo $checkContent;
	}
	else
	{
		$postContent['message'] = $content;

		if( $DB->query( $DB->update_sql("`".$table_post2."`",$postContent,"`pid`=".$_POST['pid']) ) )
		{
			echo "修改成功";
		}
		else
		{
			echo "修改失败";
		}
	}

	$DB->close();

	exit;
}

$where = "";

if( isset($_GET['tid']) && is_numeric($_GET['tid']) )
{
	$where = "WHERE `tid` = ".$_GET['tid'];
}

$postArr = $QA->getPost($where,$page,"20");

$DB->close();

unset($DB,$QA);

$tmp = & myTpl("post_list.html");

$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'postArr',  $postArr );
			 
$tmp->output();
?>