<?php
require(dirname(__FILE__)."/database/config_site.php");

require(dirname(__FILE__)."/database/config_mysql.php");

require(dirname(__FILE__)."/class/class_Mysql.php");

require(dirname(__FILE__)."/function.php");

ini_set('date.timezone',$site_timezone);

function showStr($str)
{
	$auto_arr = array(
					"/\[img\](.+?)\[\/img\]/is",
					"/\[video\](.+?)\[\/video\]/is"
					);

	$auto_url = array(
					'<img border="0" src="\\1" onError="this.src=\'./images/img_error.gif\'" />',
					'视频：\\1'
					);

	$str = preg_replace($auto_arr,$auto_url," ".filterHTML($str));

	$str = nl2br($str);

	return $str;
}

if( isset($_GET['fid']) && is_numeric($_GET['fid']) && $_GET['fid'] >= 1 )
{
	$DB = new DB_MySQL;

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$FSQL = "SELECT `fid`,`name`,`synopsis` FROM `".$table_forum."` WHERE `fid`=".$_GET['fid'];

	$ForumArr = $DB->fetch_one_array($FSQL);

	if( !empty($ForumArr['fid']) )
	{
		header("Content-Type: text/xml");

		echo '<?xml version="1.0" encoding="utf-8"?>';

		echo '<rss version="2.0">';

		echo '<channel>';

		echo '<title>'.$site_name.' - '.stripslashes($ForumArr['name']).'</title>';

		if( $site_rewrite )
			echo '<link>http://'.$site_domain.$site_catalog.'bar-'.$ForumArr['fid'].'-1.html</link>';
		else
			echo '<link>http://'.$site_domain.$site_catalog.'forum.php?fid='.$ForumArr['fid'].'</link>';

		echo '<description>'.stripslashes($ForumArr['synopsis']).'</description>';

		echo '<copyright>Copyright(C) PhpSay</copyright>';

		echo '<generator>AlanZhu</generator>';

		echo '<lastBuildDate>'.date('r').'</lastBuildDate>';

		echo '<ttl>120</ttl>';

		echo '<image>';

		echo '<url>http://'.$site_domain.$site_catalog.'images/slogo.gif</url>';

		echo '<title>'.$site_name.'</title>';

		echo '<link>http://'.$site_domain.$site_catalog.'</link>';

		echo '</image>';

		$TSQL = "SELECT I.`tid`,I.`author`,I.`subject`,I.`dateline`,T.`message` FROM `".$table_post."` I ";
		
		$TSQL .= "LEFT JOIN `".$table_post2."` T ON I.`pid`=T.`pid` ";
		
		$TSQL .= "WHERE I.`fid`=".$ForumArr['fid']." AND I.`replyfloor`=0 ORDER BY I.`pid` DESC LIMIT 50";

		$Result = $DB->query($TSQL);

		while($Re = $DB->fetch_array($Result))
		{
			echo '<item>';
			
			echo '<title>'.filterHTML($Re['subject']).'</title>';
			
			if( $site_rewrite )
				echo '<link>http://'.$site_domain.$site_catalog.'topic-'.$Re['tid'].'-1.html</link>';
			else
				echo '<link>http://'.$site_domain.$site_catalog.'topic.php?tid='.$Re['tid'].'</link>';
			
			echo '<description><![CDATA['.showStr($Re['message']).']]></description>';
			
			echo '<category>'.stripslashes($ForumArr['name']).'</category>';
			
			echo '<author>'.stripslashes($Re['author']).'</author>';
			
			echo '<pubDate>'.date('r',$Re['dateline']).'</pubDate>';
			
			echo '</item>';
		}

		echo '</channel>';

		echo '</rss>';
	}

	$DB->close();
}
?>