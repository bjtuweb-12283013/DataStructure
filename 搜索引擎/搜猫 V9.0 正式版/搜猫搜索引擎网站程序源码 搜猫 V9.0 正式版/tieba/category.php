<?php
require(dirname(__FILE__)."/global.php");

if( !isset($_GET['cid']) || !is_numeric($_GET['cid']) || $_GET['cid'] < 1 )
{
	header("location:./");
}
else
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$categoryArr = $TB->getCategoryInfo($_GET['cid']);

	if( empty($categoryArr['thisArr']['cid']) )
	{
		header("location:./");
	}
	else
	{
		$subdirectory = "";

		for($i=0;$i<count($categoryArr['categoryArr']);$i++)
		{
			$subdirectory .= $categoryArr['categoryArr'][$i]['cid'].",";
		}

		$subdirectory = substr($subdirectory,0,-1);

		if( empty($categoryArr['thatArr']['cid']) )
		{
			if( empty($subdirectory) )
			{
				$forumArr = array("Total"=>0,"Forum"=>array(),"Page"=>array("pageList"=>""));
			}
			else if( count(explode(",",$subdirectory)) == 1 )
			{
				$forumArr = $TB->getCategoryForum("=".$subdirectory,$page,15);
			}
			else
			{
				$forumArr = $TB->getCategoryForum("IN(".$subdirectory.")",$page,15);
			}
		}
		else
		{
			$forumArr = $TB->getCategoryForum("=".$categoryArr['thisArr']['cid'],$page,15);
		}

		$tmp = template("category.html");
		 
		$tmp->assign( 'codeName',  $code_name );
		 
		$tmp->assign( 'codeVersion',  $code_version );
		 
		$tmp->assign( 'siteName',  $site_name );
		 
		$tmp->assign( 'siteDomain',  $site_domain );

		$tmp->assign( 'siteCatalog',  $site_catalog );
		 
		$tmp->assign( 'siteIcp',  $site_icp );
		 
		$tmp->assign( 'searchWord',  "" );
		 
		$tmp->assign( 'searchType',  "1" );
		 
		$tmp->assign( 'loginArr',  $loginArr );
		 
		$tmp->assign( 'categoryArr',  $categoryArr );
		 
		$tmp->assign( 'forumArr',  $forumArr );
		 
		$tmp->output();
	}

	$DB->close();
}

ob_end_flush();
?>