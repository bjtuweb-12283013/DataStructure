<?php
require(dirname(__FILE__)."/global.php");

if( isset($_SERVER['HTTP_REFERER']) )
{
	$fromUrl = $_SERVER['HTTP_REFERER'];
}
else
{
	$fromUrl = "./";
}

if( isset($_GET['wd'],$_GET['tb']) && !empty($_GET['wd']) && is_numeric($_GET['tb']) )
{
	$keyword = trim(filterCode($_GET['wd']));

	$startTime = microtime(true);

	if( !empty($keyword) && $_GET['tb'] == 1 )
	{
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$forumId = $DB->fetch_one("SELECT `fid` FROM `".$table_forum."` WHERE lower(`name`)='".strtolower($keyword)."'");

		$DB->close();

		if( empty($forumId) )
		{
			header("location:./create.php?name=".urlencode(filterHTML($keyword,false)));
		}
		else
		{
			if( $site_rewrite )
				header("location:./bar-".$forumId."-1.html");
			else
				header("location:./forum.php?fid=".$forumId);
		}
	}
	else if( !empty($keyword) && $_GET['tb'] == 3 )
	{
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$userId = $DB->fetch_one("SELECT `uid` FROM `".$table_member."` WHERE lower(`name`)='".strtolower($keyword)."'");

		$DB->close();

		header("location:./search.php?wd=".urlencode(filterHTML($keyword,false))."&tb=4&id=".$userId);
	}
	else if( !empty($keyword) && $_GET['tb'] == 2 )
	{
		$searchWord = filterHTML($keyword,false);
		
		$searchType = 2;

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$searchArr = $TB->searchTopic("`subject` LIKE '%".$keyword."%'",$page,$per_topic_num);

		$DB->close();
	}
	else if( !empty($keyword) && $_GET['tb'] == 4 && isset($_GET['id']) )
	{
		$searchWord = filterHTML($keyword,false);
		
		$searchType = 3;

		if( is_numeric($_GET['id']) && $_GET['id'] >= 1 )
		{
			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$searchArr = $TB->searchTopic("`authorid` = '".$_GET['id']."'",$page,$per_topic_num);

			$DB->close();
		}
		else
		{
			$searchArr = array("TopicNum"=>0,"Topic"=>array(),"Page"=>array(),);
		}
	}

	$endTime = microtime(true);

	$searchTime = round(($endTime - $startTime),3);
	
	if( isset($searchArr) )
	{
		$tmp = template("search.html");
		 
		$tmp->assign( 'codeName',  $code_name );
		 
		$tmp->assign( 'codeVersion',  $code_version );
		 
		$tmp->assign( 'siteName',  $site_name );
		 
		$tmp->assign( 'siteDomain',  $site_domain );

		$tmp->assign( 'siteCatalog',  $site_catalog );
		 
		$tmp->assign( 'siteIcp',  $site_icp );
		 
		$tmp->assign( 'loginArr',  $loginArr );
		 
		$tmp->assign( 'searchWord',  $searchWord );
		 
		$tmp->assign( 'searchType',  $searchType );
		 
		$tmp->assign( 'searchTime',  $searchTime );
		 
		$tmp->assign( 'searchArr',  $searchArr );
		 
		$tmp->output();
	}
}
else
{
	header("location:".$fromUrl);
}

ob_end_flush();
?>