<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['pid']) && is_numeric($_GET['pid']) && $_GET['pid'] >= 1 )
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');

	$tId = $DB->fetch_one("SELECT `tid` FROM `".$table_post."` WHERE `pid`=".$_GET['pid']);

	if( $tId > 0 )
	{
		$floorNum = 0;

		$Result = $DB->query("SELECT `pid` FROM `".$table_post."` WHERE `tid`=".$tId." ORDER BY `pid` ASC");

		while($Re = $DB->fetch_array($Result))
		{
			$floorNum++;

			if( $Re['pid'] == $_GET['pid'] )
			{
				break;
			}
		}

		if( $floorNum > 0 )
		{
			$onPageNum = ceil($floorNum/$per_post_num);

			header('HTTP/1.1 301 Moved Permanently');

			if( $site_rewrite )
			{
				header("location:./topic-".$tId."-".$onPageNum.".html#f".$floorNum);
			}
			else
			{
				header("location:./topic.php?tid=".$tId."&page=".$onPageNum."#f".$floorNum);
			}
		}
	}
	else
	{
		echo "<script>alert('帖子不存在或已被删除！');location.href='./';</script>";
	}

	$DB->close();
}

ob_end_flush();
?>