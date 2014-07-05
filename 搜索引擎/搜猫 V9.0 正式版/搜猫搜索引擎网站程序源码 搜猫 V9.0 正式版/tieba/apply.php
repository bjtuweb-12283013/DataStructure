<?php
require(dirname(__FILE__)."/global.php");

if( $loginArr['state'] == 0 )
{
	header("location:./login.php");
}
else
{
	if( isset($_GET['do'],$_POST['applyreason'],$_POST['applyfid'],$_POST['applytype']) && $_GET['do'] == "apply" )
	{
		$content = trim(filterCode($_POST['applyreason']));

		$fid = intval($_POST['applyfid']);

		$type = intval($_POST['applytype']);

		$content_len = getStrlen($content);

		if( $content_len < 10 || $content_len > 90 )
		{
			echo "1 理由应控制在10到90个字之间！";
		}
		else
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$ForumArr = $TB->getForumInfo($fid);

			if( empty($ForumArr['fid']) || ($type != "1" && $type != "0") )
			{
				echo "0 非法请求！";
			}
			else
			{
				$isModerator = 0;

				for( $i=0;$i<count($ForumArr['moderator']);$i++  )
				{
					if( $ForumArr['moderator'][$i]['uid'] == $loginArr['uid'] )
					{
						$isModerator = 1;
					}
				}

				if( ($type == "1" && $isModerator == "0") || ($type == "0" && $isModerator == "1") )
				{
					$cSql = "SELECT COUNT(`aid`) FROM `".$table_apply."` WHERE `type`=".$type;

					if( $DB->fetch_one($cSql." AND `uid`=".$loginArr['uid']." AND `fid`=".$ForumArr['fid']) == 0 )
					{
						$applyArr['type'] = $type;
						$applyArr['uname'] = $loginArr['name'];
						$applyArr['uid'] = $loginArr['uid'];
						$applyArr['fname'] = $ForumArr['name'];
						$applyArr['fid'] = $ForumArr['fid'];
						$applyArr['message'] = $content;
						$applyArr['dateline'] = time();

						if( $DB->query( $DB->insert_sql("`".$table_apply."`",$applyArr) ) )
						{
							echo "0 您的申请已提交，我们会尽快处理。";
						}
						else
						{
							echo "1 数据库繁忙，请重试！";
						}
					}
					else
					{
						echo "0 您的之前的申请尚在处理中，请不要重复提交！";
					}
				}
				else
				{
					echo "0 这不是一个合理的请求！";
				}
			}
			$DB->close();
		}
	}
	else if( isset($_GET['fid']) && is_numeric($_GET['fid']) && $_GET['fid'] >= 1 )
	{
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$ForumArr = $TB->getForumInfo($_GET['fid']);

		$DB->close();

		$tmp = template("apply.html");

		$tmp->assign( 'ForumArr',  $ForumArr );
		 
		$tmp->output();
	}
}

ob_end_flush();
?>