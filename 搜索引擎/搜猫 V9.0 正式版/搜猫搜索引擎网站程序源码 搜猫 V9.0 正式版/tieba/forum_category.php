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
			if( isset($_POST['cid']) && is_numeric($_POST['cid']) )
			{
				if( $_POST['cid'] == $ForumArr['classid'] )
				{
					echo "<script>alert('分类未更改');</script>";
				}
				else
				{
					$catalogArr = $DB->fetch_one_array("SELECT * FROM `".$table_catalog."` WHERE `cid` = ".$_POST['cid']);

					if( empty($catalogArr['cid']) || $catalogArr['fatherid'] == 0 )
					{
						echo "<script>alert('无效分类');</script>";
					}
					else
					{
						$checkSql = "SELECT COUNT(`fid`) FROM `".$table_class."` WHERE `fid`=".$ForumArr['fid'];

						if( $DB->fetch_one($checkSql) == 0 )
						{
							$classArr['fid'] = $ForumArr['fid'];

							$classArr['fname'] = $ForumArr['name'];
							
							$classArr['cid'] = $catalogArr['cid'];

							$classSql = $DB->insert_sql("`".$table_class."`",$classArr);
						}
						else
						{
							$classArr['cid'] = $catalogArr['cid'];

							$classSql = $DB->update_sql("`".$table_class."`",$classArr,"`fid`=".$ForumArr['fid']);
						}

						if( $DB->query( $classSql ) )
						{
							echo "<script>alert('分类已提交，请等待管理员审核 ^_^');</script>";
						}
						else
						{
							echo "<script>alert('数据库繁忙，请稍候再试。');</script>";
						}
					}
				}
			}
			else
			{
				$categoryArr = $TB->getAllCategory();

				$tmp = template("forum_category.html");
				 
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
				 
				$tmp->assign( 'categoryArr',  $categoryArr );

				$tmp->output();
			}
		}
	}

	$DB->close();
}

ob_end_flush();
?>