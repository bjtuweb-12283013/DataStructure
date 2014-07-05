<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['forumId']) && is_numeric($_POST['forumId']) && $_POST['forumId'] >=1 )
{
	$fid = $_POST['forumId'];

	if( isset($_POST['userId']) && is_numeric($_POST['userId']) && $_POST['userId'] >=1 )
	{
		$uid = $_POST['userId'];

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$moderator = $DB->fetch_one("SELECT `moderator` FROM `".$table_forum."` WHERE `fid`=".$fid);

		$master = "";

		if( !empty($moderator) )
		{
			$exp_moderator = explode("|",$moderator);

			for($i=0;$i<count($exp_moderator);$i++)
			{
				$expModerator = explode(",",$exp_moderator[$i]);

				if( $expModerator[0] != $uid )
				{
					$master .= $expModerator[0].",".$expModerator[1]."|";
				}
			}

			if( $DB->query("UPDATE `".$table_forum."` SET `moderator`='".substr($master,0,-1)."' WHERE `fid`=".$fid) )
			{
				$DB->query("DELETE FROM `".$table_apply."` WHERE `type`=1 AND `uid`=".$uid." AND `fid`=".$fid);

				if( $DB->fetch_one("SELECT `groupid` FROM `".$table_member."` WHERE `uid`=".$uid) <= 4 )
				{
					$cSql = "SELECT COUNT(`aid`) FROM `".$table_apply."` WHERE `type`=1 AND `uid`=".$uid." AND `dispose`=1";

					if( $DB->fetch_one($cSql) == 0 )
					{
						$DB->query("UPDATE `".$table_member."` SET `groupid`=1 WHERE `uid`=".$uid);
					}
				}

				echo "1";
			}
		}

		$DB->close();
	}

	if( isset($_POST['friendId']) && is_numeric($_POST['friendId']) && $_POST['friendId'] >=1 )
	{
		$friendId = $_POST['friendId'];

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$friend = $DB->fetch_one("SELECT `friend` FROM `".$table_forum."` WHERE `fid`=".$fid);

		$friendBar = "";

		if( !empty($friend) )
		{
			$exp_friend = explode("|",$friend);

			for($i=0;$i<count($exp_friend);$i++)
			{
				$expfriend = explode(",",$exp_friend[$i]);

				if( $expfriend[0] != $friendId )
				{
					$friendBar .= $expfriend[0].",".$expfriend[1]."|";
				}
			}

			if( $DB->query("UPDATE `".$table_forum."` SET `friend`='".substr($friendBar,0,-1)."' WHERE `fid`=".$fid) )
			{
				echo "1";
			}
		}

		$DB->close();
	}

	exit;
}

if( isset($_GET['fid']) && is_numeric($_GET['fid']) && $_GET['fid'] >= 1 )
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$forumArr = $QA->getForumInfo($_GET['fid']);

	if( !empty($forumArr['fid']) )
	{
		if( isset($_POST['name'],$_POST['category'],$_POST['intro'],$_POST['push']) )
		{
			$name = strAddslashes(trim($_POST['name']));

			$cid = $_POST['category'];
			
			$intro = filterCode($_POST['intro']);

			$push = $_POST['push'];

			if( empty($name) || getStrlen($name) > 15 || !wordCheck($name) )
			{
				echo "<script>alert('换一个吧名吧');</script>";
			}
			else
			{
				$BId = $DB->fetch_one("SELECT `fid` FROM `".$table_forum."` WHERE lower(`name`)='".strtolower($name)."'");

				if( !empty($BId) && $BId != $forumArr['fid'] )
				{
					echo "<script>alert('该吧已存在，请更换吧名。');</script>";
				}
				else
				{
					if( getStrlen($intro) > 90 )
					{
						echo "<script>alert('吧简介不能超过90个字');</script>";
					}
					else
					{
						$forumInfo['cid'] = $cid;

						$forumInfo['name'] = $name;
						
						$forumInfo['synopsis'] = $intro;

						if( $forumArr['commend'] == 0 )
						{
							if( $push > 0 )
							{
								$forumInfo['commend'] = time();
							}
						}
						else
						{
							if( $push == 0 )
							{
								$forumInfo['commend'] = 0;
							}

							if( $push == 2 )
							{
								$forumInfo['commend'] = time();
							}
						}

						if( $DB->query( $DB->update_sql("`".$table_forum."`",$forumInfo,"`fid`=".$forumArr['fid']) ) )
						{
							echo "<script>alert('修改成功！');top.location.reload();</script>";
						}
						else
						{
							echo "<script>alert('数据库繁忙，请重新提交！');</script>";
						}
					}
				}
			}
		}
		else
		{
			$category = $QA->getCategory();

			$tmp = & myTpl("forum_edit.html");

			$tmp->assign( 'codeName',  $code_name );
						 
			$tmp->assign( 'codeVersion',  $code_version );
						 
			$tmp->assign( 'siteName',  $site_name );
						 
			$tmp->assign( 'siteDomain',  $site_domain );
						 
			$tmp->assign( 'siteCatalog',  $site_catalog );
						 
			$tmp->assign( 'forumArr',  $forumArr );
						 
			$tmp->assign( 'category',  $category );
						 
			$tmp->output();
		}
	}
	else
	{
		echo "<script>top.location.href='./forum_list.php';</script>";
	}

	$DB->close();

	unset($DB,$QA);
}
else
{
	header("location:./forum_list.php");
}
?>