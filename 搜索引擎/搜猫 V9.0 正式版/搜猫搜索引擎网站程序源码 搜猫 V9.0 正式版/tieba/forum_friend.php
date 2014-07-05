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
			if( isset($_GET['do'],$_POST['bar']) && $_GET['do'] == "append" )
			{
				$forumName = strAddslashes(trim($_POST['bar']));

				if( empty($forumName) || !wordCheck($forumName) )
				{
					echo "<script>alert('请输入正确的同盟吧吧名');</script>";
				}
				else
				{
					$FSQL = "SELECT `fid`,`name` FROM `".$table_forum."` WHERE lower(`name`)='".strtolower($forumName)."'";

					$FriendArr = $DB->fetch_one_array($FSQL);

					if( empty($FriendArr['fid']) || $FriendArr['fid'] == $ForumArr['fid'] )
					{
						echo "<script>alert('吧名无效');</script>";
					}
					else
					{
						for( $j=0;$j<count($ForumArr['friend']);$j++  )
						{
							if( $ForumArr['friend'][$j]['fid'] == $FriendArr['fid'] )
							{
								$isFriend = 1;
							}
						}

						if( isset($isFriend) )
						{
							echo "<script>alert('该同盟吧已存在');</script>";
						}
						else
						{
							if( count($ForumArr['friend']) >= 5 )
							{
								echo "<script>alert('每个吧最多可以添加5个同盟吧');</script>";
							}
							else
							{
								if( empty($ForumArr['league']) )
								{
									$newFriend = $FriendArr['fid'].",".$FriendArr['name'];
								}
								else
								{
									$newFriend = $ForumArr['league']."|".$FriendArr['fid'].",".$FriendArr['name'];
								}

								$barArr['friend'] = $newFriend;

								if( $DB->query($DB->update_sql("`".$table_forum."`",$barArr,"`fid`=".$ForumArr['fid'])) )
								{
									echo "<script>top.location.href=top.location.href;</script>";
								}
								else
								{
									echo "<script>alert('数据库繁忙，请重新提交！');</script>";
								}
							}
						}
					}
				}
			}
			if( isset($_GET['do'],$_GET['bid']) && $_GET['do'] == "delete" )
			{
				$FriendStr= "";

				for( $j=0;$j<count($ForumArr['friend']);$j++  )
				{
					if( $ForumArr['friend'][$j]['fid'] != $_GET['bid'] )
					{
						$FriendStr .= $ForumArr['friend'][$j]['fid'].",".$ForumArr['friend'][$j]['name']."|";
					}
				}

				$barArr['friend'] = substr($FriendStr,0,-1);

				$DB->query($DB->update_sql("`".$table_forum."`",$barArr,"`fid`=".$ForumArr['fid']));

				echo "<script>alert('删除成功');top.location.href='./forum_friend.php?fid=".$ForumArr['fid']."';</script>";
			}
			else
			{
				$tmp = template("forum_friend.html");
				 
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