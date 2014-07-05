<?php
require(dirname(__FILE__)."/global.php");

if( $loginArr['group'] >= 4 && isset($_POST['op'],$_POST['ac'],$_POST['id'],$_POST['fid']) && intval($_POST['id']) >= 1 )
{
	$manageAuth = 1;

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	if( $_POST['op'] == "delete" && $_POST['ac'] == "1" )
	{
		$postArr = $DB->fetch_one_array("SELECT `fid`,`tid`,`authorid` FROM `".$table_post."` WHERE `pid`=".$_POST['id']);
	}
	else
	{
		$postArr = $DB->fetch_one_array("SELECT `fid`,`authorid` FROM `".$table_topic."` WHERE `tid`=".$_POST['id']);
	}

	if( empty($postArr['fid']) || $postArr['fid'] != $_POST['fid'] )
	{
		if( $site_rewrite )
		{
			echo "0 ./bar-".$_POST['fid']."-1.html";
		}
		else
		{
			echo "0 ./forum.php?fid=".$_POST['fid'];
		}
	}
	else
	{
		if( $loginArr['group'] == 4 )
		{
			$manageAuth = 0;

			$ForumArr = $DB->fetch_one("SELECT `moderator` FROM `".$table_forum."` WHERE `fid`=".$postArr['fid']);

			if( !empty($ForumArr['moderator']) )
			{
				$exp_moderator = explode("|",stripslashes($ForumArr['moderator']));

				for($i=0;$i<count($exp_moderator);$i++)
				{
					if( $exp_moderator[$i] = $loginArr['uid'].",".$loginArr['name'] )
					{
						$manageAuth = 1;
					}
				}
			}
		}

		if( $manageAuth == 0 )
		{
			echo "1 越权操作";
		}
		else
		{
			if( $_POST['op'] == "delete" )
			{
				if( $_POST['ac'] == "0" )
				{
					$DB->query("DELETE FROM `".$table_topic."` WHERE `tid`=".$_POST['id']);
					
					$DB->query("DELETE FROM `".$table_post."` WHERE `tid`=".$_POST['id']);
					
					$delPostNum = $DB->affected_rows("DELETE FROM `".$table_post2."` WHERE `tid`=".$_POST['id']);

					if( $delPostNum > 0 )
					{
						if( $postArr['authorid'] > 0 && $integral_topic > 0 )
						{
							$userInfoArr = array( 'integral' => array("`integral`-".$integral_topic."") );

							$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$postArr['authorid']) );
						}

						if( $site_rewrite )
						{
							echo "0 ./bar-".$postArr['fid']."-1.html";
						}
						else
						{
							echo "0 ./forum.php?fid=".$postArr['fid'];
						}
					}
					else
					{
						echo "1 数据库繁忙";
					}
				}

				if( $_POST['ac'] == "1" )
				{
					if( !empty($postArr['tid']) )
					{
						$DB->query("DELETE FROM `".$table_post."` WHERE `pid`=".$_POST['id']);

						$delPostNum = $DB->affected_rows("DELETE FROM `".$table_post2."` WHERE `pid`=".$_POST['id']);

						if( $delPostNum > 0 )
						{
							$LSQL = "SELECT `author`,`authorid`,`authorico`,`dateline` FROM `".$table_post."` WHERE ";

							$lastArr = $DB->fetch_one_array($LSQL."`tid`=".$postArr['tid']." ORDER BY `pid` DESC LIMIT 1");
							
							$topicInfo['lasttime'] = $lastArr['dateline'];
							
							$topicInfo['lastauthor'] = $lastArr['author'];
							
							$topicInfo['lastauthorid'] = $lastArr['authorid'];
							
							$topicInfo['lastauthorico'] = $lastArr['authorico'];

							$topicInfo['replies'] = array("`replies`-1");

							$DB->query($DB->update_sql("`".$table_topic."`",$topicInfo,"`tid`=".$postArr['tid']));

							$theFloor = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `tid`=".$postArr['tid']." AND `pid`<".$_POST['id']);

							$theFloor++;

							$postInfo['replyfloor'] = 1;

							$DB->query($DB->update_sql("`".$table_post."`",$postInfo,"`tid`=".$postArr['tid']." AND `pid`>0 AND `replyfloor`=".$theFloor));

							$postInfo['replyfloor'] = array("`replyfloor`-1");

							$pSqlWhere = "`tid`=".$postArr['tid']." AND `pid`>".$_POST['id']." AND `replyfloor`>".$theFloor;

							$DB->query($DB->update_sql("`".$table_post."`",$postInfo,$pSqlWhere));

							if( $postArr['authorid'] > 0 && $integral_reply > 0 )
							{
								$userInfoArr = array( 'integral' => array("`integral`-".$integral_reply."") );

								$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$postArr['authorid']) );
							}

							echo "0 OK";
						}
						else
						{
							echo "1 操作重复";
						}
					}
					else
					{
						echo "0 OK";
					}
				}
			}
			else
			{
				if( in_array($_POST['op'],array("digest","stick","lockout")) && ($_POST['ac'] == "0" || $_POST['ac'] == "1") )
				{
					$updateArr = array( $_POST['op'] => $_POST['ac'] );

					if( $DB->affected_rows( $DB->update_sql("`".$table_topic."`",$updateArr,"`tid`=".$_POST['id']) ) > 0 )
					{
						if( $_POST['op'] == "digest" && $postArr['authorid'] > 0 && $integral_elite > 0 )
						{
							if( $_POST['ac'] == "0" )
							{
								$integral_elite = 0 - $integral_elite;
							}

							$userInfoArr = array( 'integral' => array("`integral`+".$integral_elite."") );

							$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$postArr['authorid']) );
						}

						echo "0 OK";
					}
					else
					{
						echo "1 数据库繁忙";
					}
				}
			}
		}
	}

	$DB->close();
}

if( $loginArr['group'] >= 4 && isset($_POST['op']) && $_POST['op'] == "batchDelete" )
{
	if( isset($_POST['fid'],$_POST['tid'],$_POST['pid']) )
	{
		$manageAuth = 1;

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$forumId = $DB->fetch_one("SELECT `fid` FROM `".$table_topic."` WHERE `tid`=".$_POST['tid']);

		if( empty($forumId) || $forumId != $_POST['fid'] )
		{
			if( $site_rewrite )
			{
				echo "0 ./bar-".$_POST['fid']."-1.html";
			}
			else
			{
				echo "0 ./forum.php?fid=".$_POST['fid'];
			}
		}
		else
		{
			if( $loginArr['group'] == 4 )
			{
				$manageAuth = 0;

				$ForumArr = $DB->fetch_one("SELECT `moderator` FROM `".$table_forum."` WHERE `fid`=".$forumId);

				if( !empty($ForumArr['moderator']) )
				{
					$exp_moderator = explode("|",stripslashes($ForumArr['moderator']));

					for($i=0;$i<count($exp_moderator);$i++)
					{
						if( $exp_moderator[$i] = $loginArr['uid'].",".$loginArr['name'] )
						{
							$manageAuth = 1;
						}
					}
				}
			}

			if( $manageAuth == 0 )
			{
				echo "1 越权操作";
			}
			else
			{
				$topicId = $_POST['tid'];

				$expPostId = explode(",",$_POST['pid']);

				$postArr = $DB->fetch_one_array("SELECT `pid`,`authorid` FROM `".$table_post."` WHERE `tid`=".$topicId." AND `pid`>0 AND `replyfloor`=0");

				if( in_array($postArr['pid'],$expPostId) )
				{
					$DB->query("DELETE FROM `".$table_topic."` WHERE `tid`=".$topicId);
					
					$DB->query("DELETE FROM `".$table_post."` WHERE `tid`=".$topicId);
					
					$delPostNum = $DB->affected_rows("DELETE FROM `".$table_post2."` WHERE `tid`=".$topicId);

					if( $delPostNum > 0 && $postArr['authorid'] > 0 && $integral_topic > 0 )
					{
						$userInfoArr = array( 'integral' => array("`integral`-".$integral_topic."") );

						$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$postArr['authorid']) );
					}
					
					if( $site_rewrite )
					{
						echo "0 ./bar-".$forumId."-1.html";
					}
					else
					{
						echo "0 ./forum.php?fid=".$forumId;
					}
				}
				else
				{
					$DB->query("DELETE FROM `".$table_post2."` WHERE `tid`=".$topicId." AND `pid` IN (".$_POST['pid'].")");

					$delNum = 0;

					foreach( $expPostId as $Id )
					{
						$authorId = $DB->fetch_one("SELECT `authorid` FROM `".$table_post."` WHERE `tid`=".$topicId." AND `pid`=".$Id);

						$delPostNum = $DB->affected_rows("DELETE FROM `".$table_post."` WHERE `tid`=".$topicId." AND `pid`=".$Id);

						if( $delPostNum > 0 )
						{
							$delNum++;

							$thisFloor = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `tid`=".$topicId." AND `pid`<".$Id);

							$thisFloor++;

							$postInfo['replyfloor'] = 1;

							$DB->query($DB->update_sql("`".$table_post."`",$postInfo,"`tid`=".$topicId." AND `pid`>0 AND `replyfloor`=".$thisFloor));

							$postInfo['replyfloor'] = array("`replyfloor`-1");

							$DB->query($DB->update_sql("`".$table_post."`",$postInfo,"`tid`=".$topicId." AND `pid`>".$Id." AND `replyfloor`>".$thisFloor));

							if( $authorId > 0 && $integral_reply > 0 )
							{
								$userInfoArr = array( 'integral' => array("`integral`-".$integral_reply."") );

								$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$authorId) );
							}
						}
					}

					if( $delNum > 0 )
					{
						$LSQL = "SELECT `author`,`authorid`,`authorico`,`dateline` FROM `".$table_post."` WHERE `tid`=".$topicId." ORDER BY `pid` DESC";

						$lastArr = $DB->fetch_one_array($LSQL." LIMIT 1");
									
						$topicInfo['lasttime'] = $lastArr['dateline'];
									
						$topicInfo['lastauthor'] = $lastArr['author'];
									
						$topicInfo['lastauthorid'] = $lastArr['authorid'];
									
						$topicInfo['lastauthorico'] = $lastArr['authorico'];

						$topicInfo['replies'] = array("`replies`-".$delNum);

						$DB->query( $DB->update_sql("`".$table_topic."`",$topicInfo,"`tid`=".$topicId) );
					}

					echo "0 OK";
				}
			}
		}

		$DB->close();
	}
}

if( $loginArr['group'] >= 4 && isset($_POST['fid'],$_POST['uid'],$_POST['str'],$_POST['op']) && $_POST['op'] == "blockade" )
{
	$manageAuth = 1;

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	if( $loginArr['group'] == 4 )
	{
		$manageAuth = 0;

		$ForumArr = $DB->fetch_one("SELECT `moderator` FROM `".$table_forum."` WHERE `fid`='".$_POST['fid']."'");

		if( !empty($ForumArr['moderator']) )
		{
			$exp_moderator = explode("|",stripslashes($ForumArr['moderator']));

			for($i=0;$i<count($exp_moderator);$i++)
			{
				if( $exp_moderator[$i] = $loginArr['uid'].",".$loginArr['name'] )
				{
					$manageAuth = 1;
				}
			}
		}
	}

	if( $_POST['uid'] > 0 )
	{
		$groupId = $DB->fetch_one("SELECT `groupid` FROM `".$table_member."` WHERE `uid`='".$_POST['uid']."'");

		if( $groupId == "" || $groupId >= $loginArr['group'] )
		{
			$manageAuth = 0;
		}
	}

	if( $manageAuth == 0 )
	{
		echo "越权操作";
	}
	else
	{
		$BlackSQL = "SELECT COUNT(`bid`) FROM `".$table_black."` WHERE ";

		$BlackSQL .= ($_POST['uid'] > 0) ? "`uid`=".$_POST['uid'] : "`uname`='".$_POST['str']."'";

		if( $DB->fetch_one($BlackSQL." AND (`fid`=".$_POST['fid']." OR `fid`=0)") > 0 )
		{
			echo "已封锁";
		}
		else
		{
			$blackInfo = array(
								'fid'		=> $_POST['fid'],
								'uid'		=> $_POST['uid'],
								'uname'		=> $_POST['str'],
								'dateline'	=> time(),
								'adminid'	=> $loginArr['uid'],
								'adminname'	=> $loginArr['name']
								);

			if( $DB->query( $DB->insert_sql("`".$table_black."`",$blackInfo) ) )
			{
				echo "封锁成功";
			}
			else
			{
				echo "数据库繁忙";
			}
		}
	}

	$DB->close();
}

ob_end_flush();
?>