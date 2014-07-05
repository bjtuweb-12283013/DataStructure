<?php
require(dirname(__FILE__)."/global.php");

if( $loginArr['state'] == 0 )
{
	header("location:./login.php");
}
else
{
	if( isset($_GET['do'],$_POST['reportcontent'],$_POST['reportpid']) && $_GET['do'] == "report" )
	{
		$content = trim(filterCode($_POST['reportcontent']));

		$pid = intval($_POST['reportpid']);

		$content_len = getStrlen($content);

		if( $content_len < 3 || $content_len > 80 )
		{
			echo "1 举报原由应控制在3到80个字之间";
		}
		else
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$postArr = $TB->getPostInfo($pid);

			if( empty($postArr['pid']) )
			{
				echo "0 该帖已被删除！";
			}
			else
			{
				$reportArr['uname'] = $loginArr['name'];
				$reportArr['uid'] = $loginArr['uid'];
				$reportArr['fid'] = $postArr['fid'];
				$reportArr['tid'] = $postArr['tid'];
				$reportArr['pid'] = $postArr['pid'];
				$reportArr['author'] = $postArr['author'];
				$reportArr['authorid'] = $postArr['authorid'];
				$reportArr['message'] = $content;
				$reportArr['dateline'] = time();

				if( $DB->query( $DB->insert_sql("`".$table_report."`",$reportArr) ) )
				{
					echo "0 举报成功，感谢您对本吧的支持。";
				}
				else
				{
					echo "1 数据库繁忙，请重试！";
				}
			}

			$DB->close();
		}
	}
	else if( isset($_GET['pid']) && is_numeric($_GET['pid']) && $_GET['pid'] >= 1 )
	{
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$postArr = $TB->getPostInfo($_GET['pid']);

		$DB->close();

		$tmp = template("report.html");

		$tmp->assign( 'postArr',  $postArr );
		 
		$tmp->output();
	}
}

ob_end_flush();
?>