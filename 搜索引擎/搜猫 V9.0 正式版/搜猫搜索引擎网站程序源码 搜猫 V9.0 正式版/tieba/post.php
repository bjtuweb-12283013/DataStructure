<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['do'],$_POST['fid'],$_POST['title'],$_POST['content']) && $_POST['do'] == "Topic" )
{
	if( $userGroup[$loginArr['group']]['topic'] == 0 )
	{
		die("0 ".$userGroup[$loginArr['group']]['name']."不能发表主题帖");
	}

	$postTime = time();

	if( isset($_COOKIE['lastPostTime']) && ( $postTime - $_COOKIE['lastPostTime'] ) < 15 )
	{
		die("0 您的发帖速度太快了！");
	}

	$title = ltrim(filterCode($_POST['title']));

	$title_len = getStrlen($title);

	if( $title_len < 3 || $title_len > 32 )
	{
		die("0 帖子标题：至少3个字符，不超过32个字符");
	}

	if( !filterCheck($title) )
	{
		die("0 帖子标题中含有系统不允许的关键词");
	}

	$content = filterCode(htmlToUBB($_POST['content']),false);

	$checkContent = checkPostContent($content,5,22);

	if( $checkContent != "" )
	{
		die("0 ".$checkContent);
	}

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$forumArr = $DB->fetch_one_array("SELECT `fid`,`moderator` FROM `".$table_forum."` WHERE `fid`='".$_POST['fid']."'");

	if( empty($forumArr['fid']) )
	{
		echo "0 该吧不存在或者已被删除";
	}
	else
	{
		if( $loginArr['state'] == 1 )
		{
			$authorid = $loginArr['uid'];

			$author = $loginArr['name'];

			if( $loginArr['group'] == 4 )
			{
				if( !in_array( $authorid.",".$author, explode( "|", stripslashes($forumArr['moderator']) ) ) )
				{
					$loginArr['group'] = 2;
				}
			}
		}

		if( !isset($userGroup[$loginArr['group']]['verify']) || $userGroup[$loginArr['group']]['verify'] != 0 )
		{
			if( isset($_POST['verifyNum']) )
			{
				$verifyNum = strtolower(trim($_POST['verifyNum']));

				$verifyMD5 = md5(base64_encode(md5($verifyNum)));

				if( strlen($verifyNum) != 4 || !isset($_COOKIE['topicVerify']) || $_COOKIE['topicVerify'] != $verifyMD5 )
				{
					$DB->close();

					die("0 topic");
				}
			}
			else
			{
				$DB->close();

				die("0 请重新加载页面后再发布帖子");
			}
		}

		$userIP = getClientIP();

		if( ( isset($_POST['anony']) && $post_anonymous == 1 ) || $loginArr['state'] == 0 )
		{
			$authorid = 0;

			if( $loginArr['state'] == 1 || empty($loginArr['name']) )
			{
				$expIP = explode(".",$userIP);

				$author = $expIP[0].".".$expIP[1].".".$expIP[2].".*";
			}
			else
			{
				$author = $loginArr['name'];
			}

			$loginArr['group'] = 0;
		}

		$guestname = 0;

		if( $loginArr['state'] == 0 && $loginArr['name'] != "" )
		{
			$guestname = 1;
		}

		$banSql = "SELECT COUNT(`bid`) FROM `".$table_black."` WHERE ";

		$banSql .= ($loginArr['state'] == 1) ? "`uid`=".$loginArr['uid'] : "`uname`='".$userIP."'";

		if( $DB->fetch_one($banSql." AND (`fid`=".$forumArr['fid']." OR `fid`=0)") > 0 )
		{
			$DB->close();

			die("0 您被系统禁言，请与该吧吧主联系。");
		}

		$topicInfo['fid'] = $forumArr['fid'];

		$topicInfo['author'] = $author;

		$topicInfo['authorid'] = $authorid;

		$topicInfo['authorico'] = $loginArr['group'];

		$topicInfo['subject'] = $title;

		$topicInfo['dateline'] = $postTime;

		$topicInfo['lasttime'] = $postTime;

		$topicInfo['lastauthor'] = $author;

		$topicInfo['lastauthorid'] = $authorid;

		$topicInfo['lastauthorico'] = $loginArr['group'];

		if( $DB->query( $DB->insert_sql("`".$table_topic."`",$topicInfo) ) )
		{
			$topicId = $DB->insert_id();

			$postInfo['fid'] = $forumArr['fid'];

			$postInfo['tid'] = $topicId;

			$postInfo['replyfloor'] = 0;

			$postInfo['author'] = $author;

			$postInfo['authorid'] = $authorid;

			$postInfo['authorico'] = $loginArr['group'];

			$postInfo['guestname'] = $guestname;

			$postInfo['subject'] = $title;

			$postInfo['dateline'] = $postTime;

			$postInfo['postip'] = $userIP;

			if( $DB->query( $DB->insert_sql("`".$table_post."`",$postInfo) ) )
			{
				$postId = $DB->insert_id();

				$postContent = array('pid'=>$postId,'tid'=>$topicId,'message'=>$content);

				if( $DB->query( $DB->insert_sql("`".$table_post2."`",$postContent) ) )
				{
					if( $authorid > 0 && $integral_topic > 0 )
					{
						$userInfoArr = array( 'integral' => array("`integral`+".$integral_topic."") );

						$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$authorid) );
					}
					
					setcookie("lastPostTime",$postTime,$postTime+3600,"/");
					
					setcookie("topicVerify","",$postTime-3600);

					if( $site_rewrite )
					{
						echo "1 ".$site_catalog."topic-".$topicId."-1.html";
					}
					else
					{
						echo "1 ".$site_catalog."topic.php?tid=".$topicId;
					}
				}
				else
				{
					$DB->query("DELETE FROM `".$table_topic."` WHERE `tid=`".$topicId);

					$DB->query("DELETE FROM `".$table_post."` WHERE `tid=`".$topicId);

					echo "0 数据库繁忙，请重新提交！";
				}
			}
			else
			{
				$DB->query("DELETE FROM `".$table_topic."` WHERE `tid=`".$topicId);

				echo "0 数据库繁忙，请重新提交！";
			}
		}
		else
		{
			echo "0 服务器繁忙，请重新提交！";
		}
	}

	$DB->close();
}

if( isset($_POST['do']) && $_POST['do'] == "Reply" )
{
	if( $userGroup[$loginArr['group']]['reply'] == 0 )
	{
		die("0 ".$userGroup[$loginArr['group']]['name']."不能回复帖子");
	}

	$postTime = time();

	if( isset($_COOKIE['lastPostTime']) && ( $postTime - $_COOKIE['lastPostTime'] ) < 10 )
	{
		die("0 您的回帖速度太快了！");
	}

	if( isset($_POST['tid'],$_POST['fid'],$_POST['title'],$_POST['content']) )
	{
		$topicId = intval($_POST['tid']);

		$forumId = intval($_POST['fid']);

		$floorId = intval(preg_replace("/回复(\d+)：(.*)/is", "\\1", $_POST['title']));

		if( $floorId < 1 )
		{
			$floorId = 1;
		}

		$content = filterCode(htmlToUBB($_POST['content']),false);

		$checkContent = checkPostContent($content);

		if( $checkContent != "" )
		{
			die("0 ".$checkContent);
		}
		
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$forumArr = $DB->fetch_one_array("SELECT `fid`,`moderator` FROM `".$table_forum."` WHERE `fid`=".$forumId);

		if( empty($forumArr['fid']) )
		{
			$DB->close();

			die("0 该吧不存在或者已被删除");
		}

		if( $DB->fetch_one("SELECT `lockout` FROM `".$table_topic."` WHERE `tid`=".$topicId) != 0 )
		{
			$DB->close();

			die("0 该主题已被锁定，禁止回复！");
		}

		$postTotal = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `tid`=".$topicId);

		if( $postTotal < 1 || $floorId > $postTotal )
		{
			$DB->close();

			die("0 该帖不存在或者已被删除");
		}

		if( $loginArr['state'] == 1 )
		{
			$authorid = $loginArr['uid'];

			$author = $loginArr['name'];

			if( $loginArr['group'] == 4 )
			{
				if( !in_array( $authorid.",".$author, explode( "|", stripslashes($forumArr['moderator']) ) ) )
				{
					$loginArr['group'] = 2;
				}
			}
		}

		if( !isset($userGroup[$loginArr['group']]['verify']) || $userGroup[$loginArr['group']]['verify'] != 0 )
		{
			if( isset($_POST['verifyNum']) )
			{
				$vfNum = strtolower(trim($_POST['verifyNum']));

				$vfMD5 = md5(base64_encode(md5($vfNum)));

				if( strlen($vfNum) != 4 || !isset($_COOKIE['replyVerify']) || $_COOKIE['replyVerify'] != $vfMD5 )
				{
					$DB->close();

					die("0 reply");
				}
			}
			else
			{
				$DB->close();

				die("0 请重新加载页面后再发布帖子");
			}
		}

		$userIP = getClientIP();

		if( ( isset($_POST['anony']) && $post_anonymous == 1 ) || $loginArr['state'] == 0 )
		{
			$authorid = 0;

			if( $loginArr['state'] == 1 || empty($loginArr['name']) )
			{
				$expIP = explode(".",$userIP);
				
				$author = $expIP[0].".".$expIP[1].".".$expIP[2].".*";
			}
			else
			{
				$author = $loginArr['name'];
			}

			$loginArr['group'] = 0;
		}

		$guestname = 0;

		if( $loginArr['state'] == 0 && $loginArr['name'] != "" )
		{
			$guestname = 1;
		}

		$banSql = "SELECT COUNT(`bid`) FROM `".$table_black."` WHERE ";

		$banSql .= ($loginArr['state'] == 1) ? "`uid`=".$loginArr['uid'] : "`uname`='".$userIP."'";

		if( $DB->fetch_one($banSql." AND (`fid`=".$forumArr['fid']." OR `fid`=0)") > 0 )
		{
			$DB->close();

			die("0 您被系统禁言，请与该吧吧主联系。");
		}

		$postInfo['fid'] = $forumArr['fid'];

		$postInfo['tid'] = $topicId;

		$postInfo['replyfloor'] = $floorId;

		$postInfo['author'] = $author;

		$postInfo['authorid'] = $authorid;

		$postInfo['authorico'] = $loginArr['group'];

		$postInfo['guestname'] = $guestname;

		$postInfo['subject'] = "";

		$postInfo['dateline'] = $postTime;

		$postInfo['postip'] = $userIP;

		if( $DB->query( $DB->insert_sql("`".$table_post."`",$postInfo) ) )
		{
			$postId = $DB->insert_id();

			$postContent = array( 'pid'=>$postId, 'tid'=>$topicId, 'message'=>$content );

			if( $DB->query( $DB->insert_sql("`".$table_post2."`",$postContent) ) )
			{
				$topicInfo['lasttime'] = $postTime;

				$topicInfo['lastauthor'] = $author;

				$topicInfo['lastauthorid'] = $authorid;

				$topicInfo['lastauthorico'] = $loginArr['group'];

				$topicInfo['replies'] = array("`replies`+1");

				$DB->query( $DB->update_sql("`".$table_topic."`",$topicInfo,"`tid`=".$topicId) );

				if( $authorid > 0 && $integral_reply > 0 )
				{
					$userInfoArr = array( 'integral' => array("`integral`+".$integral_reply."") );

					$DB->query( $DB->update_sql("`".$table_member."`",$userInfoArr,"`uid`=".$authorid) );
				}
				
				setcookie("lastPostTime",$postTime,$postTime+3600,"/");
				
				setcookie("replyVerify","",$postTime-3600);

				$lastPage = ceil(($postTotal+1)/$per_post_num);

				if( $site_rewrite )
				{
					echo "1 ".$site_catalog."topic-".$topicId."-".$lastPage.".html";
				}
				else
				{
					echo "1 ".$site_catalog."topic.php?tid=".$topicId."&page=".$lastPage;
				}
			}
			else
			{
				$DB->query("DELETE FROM `".$table_post."` WHERE `pid=`".$postId);

				echo "0 数据库繁忙，请重新提交！";
			}
		}
		else
		{
			echo "0 数据库繁忙，请重新提交！";
		}

		$DB->close();
	}
}

if( isset($_POST['op'],$_POST['pid'],$_POST['opinion']) && $_POST['op'] == "standpoint" )
{
	if( !is_numeric($_POST['pid']) || $_POST['pid'] < 1 )
	{
		die("1 非法参数");
	}

	$cookie_name = "standpoint_".$_POST['pid'];

	if( isset($_COOKIE[$cookie_name]) && ( time() - $_COOKIE[$cookie_name] ) < 3600 )
	{
		die("1 您的速度太快了");
	}

	if( $_POST['opinion'] == 1 )
	{
		$updateInfo['up'] = array("`up`+1");
	}
	elseif( $_POST['opinion'] == 2 )
	{
		$updateInfo['down'] = array("`down`+1");
	}
	elseif( $_POST['opinion'] == 3 )
	{
		$updateInfo['wave'] = array("`wave`+1");
	}
	else
	{
		die("1 非法参数");
	}

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');

	if( $DB->query( $DB->update_sql("`".$table_post."`",$updateInfo,"`pid`='".$_POST['pid']."'") ) )
	{
		setcookie($cookie_name,time(),time()+3600,"/");

		echo "0 成功";
	}
	else
	{
		echo "1 数据库繁忙";
	}

	$DB->close();
}

if( isset($_POST['op'],$_POST['tid']) && $_POST['op'] == "topicStat" )
{
	if( is_numeric($_POST['tid']) && $_POST['tid'] >= 1 )
	{
		$cookie_name = "topic_".$_POST['tid'];

		if( !isset($_COOKIE[$cookie_name]) || ( time() - $_COOKIE[$cookie_name] ) > 3600 )
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');

			$statInfo['views'] = array("`views`+1");

			if( $DB->query( $DB->update_sql("`".$table_topic."`",$statInfo,"`tid`='".$_POST['tid']."'") ) )
			{
				setcookie($cookie_name,time(),time()+3600,"/");
			}

			$DB->close();
		}
	}
}

ob_end_flush();
?>